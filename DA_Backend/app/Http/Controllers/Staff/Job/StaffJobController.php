<?php

namespace App\Http\Controllers\Staff\Job;

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
    public function startJob(Request $request)
    {
        $jobIds = $request->input('job_ids');

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

        return redirect()->back();
    }
   public function jobDone($id)
{
    $job = Job::find($id);

    if ($job) {
        $job->status = 'Đã hoàn thành';
        $job->save();
    }
    DB::table('notification')->insert(['booking_id'=>$job->id_booking,'title' => 'Công việc','content' => 'Đã hoàn thành lịch của','created_at' =>now()]);
    return redirect()->back();
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
}
