<?php

namespace App\Http\Controllers\Staff\Job;

use Carbon\Carbon;
use App\Models\Job;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StaffJobController extends Controller
{
    public function currentJob()
    {
        $phone = session('phone');
        $user = User::where('phone', $phone)->first();
        $staff = Staff::where('id_user', $user->id)->first();
        $jobs = DB::table('jobs')
            ->join('booking', 'booking.id', 'jobs.id_booking')
            ->select('booking.name', 'jobs.*')
            ->where('jobs.id_staff', $staff->id)
            ->where('jobs.status', 'LIKE', 'Đang chờ nhận việc')
            ->orWhere('jobs.status', 'LIKE', 'Đang làm')
            ->orWhere('jobs.status', 'LIKE', 'Đã xong')
            ->get();

        foreach ($jobs as $job) {
            $booking = DB::table('booking')
                ->where('id', $job->id_booking)
                ->first();

            if ($booking) {
                $model_car = $booking->model_car;
                $job->model_car = $model_car;
            }
        }
        return view('staff/pages/jobs/currentJob', compact('jobs'));
    }
    public function jobAction(Request $request)
    {
        $action = $request->input('action');
        $jobIds = $request->input('job_ids');
        if ($action == 'done') {
            foreach ($jobIds as $jobId) {
                $job = Job::find($jobId);
                if ($job) {
                    $job->status = 'Đã hoàn thành';
                    $job->created_at = Carbon::now();
                    $job->save();
                }
                $statusStaff = Staff::find($job->id_staff);
                if ($statusStaff) {
                    $statusStaff->status = "Đang đợi việc";
                    $statusStaff->save();
                }
                DB::table('notification')->insert(['booking_id' => $job->id_booking, 'title' => 'Công việc', 'content' => 'Đã hoàn thành lịch của', 'created_at' => now()]);
            }
            return redirect()->back()->with('message', 'Công việc đã hoàn thành');
        } elseif ($action == 'start') {
            foreach ($jobIds as $jobId) {
                $job = Job::find($jobId);

                if ($job) {
                    $job->status = 'Đang làm';
                    $job->save();
                }
                $statusStaff = Staff::find($job->id_staff);
                if ($statusStaff) {
                    $statusStaff->status = "Đang làm";
                    $statusStaff->save();
                }
            }
            return redirect()->back()->with('message', 'Công việc đã bắt đầu làm');
        }
    }
    public function jobComplete()
    {
        $phone = session('phone');
        $user = User::where('phone', $phone)->first();
        $staff = Staff::where('id_user', $user->id)->first();
        $jobs = DB::table('jobs')
            ->join('booking', 'booking.id', 'jobs.id_booking')
            ->select('booking.name', 'jobs.*')
            ->where('jobs.id_staff', $staff->id)
            ->where('jobs.status', 'LIKE', 'Đã hoàn thành')
            ->get();

        foreach ($jobs as $job) {
            $booking = DB::table('booking')
                ->where('id', $job->id_booking)
                ->first();

            if ($booking) {
                $model_car = $booking->model_car;
                $job->model_car = $model_car;
            }
        }
        return view('staff/pages/jobs/jobComplete', compact('jobs'));
    }
    public function bookingDetail($id)
    {
        $booking = DB::table('booking')
            ->select('id', 'name', 'phone', 'email', 'target_date', 'target_time', 'note', 'status', 'total_price', 'model_car', 'mileage', 'license_plate',  'created_at')
            ->where('id', $id)
            ->first();
        $service = DB::table('booking_detail')
            ->join('services', 'services.id', 'booking_detail.id_service')
            ->select('services.service_name')
            ->where('booking_detail.id_booking', $id)
            ->first();
        $jobs = DB::table('jobs')
            ->select('id', 'item_name', 'item_price', 'target_time_done', 'note')
            ->where('id_booking', $booking->id)
            ->get();
        $total_price = DB::table('jobs')
            ->select(DB::raw('sum(item_price) as total_price'))
            ->where('id_booking', $booking->id)
            ->first();
        DB::table('booking')
            ->where('id', $id)
            ->update(['total_price' => $total_price->total_price]);
        $logs = DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->where('log.booking_id', $id)
            ->select('users.name as admin_name', 'log.content', 'log.created_at')
            ->get();
        return view('staff/pages/jobs/bookingDetail', compact('booking', 'jobs', 'service', 'logs', 'total_price'));
    }
}
