<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index()
    {
    $jobs = DB::table('booking')
    ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
    ->join('room', 'booking.id_room', '=', 'room.id')
    ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'room.name as room_name', DB::raw('sum(target_time_done) as time_target'))
    ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'room.name')
    ->where(function ($query) {
        $query->where('booking.status', 'LIKE', 'Đang làm')
              ->orWhere('booking.status', 'LIKE', 'Đã xong');
    })
    ->orderBy('booking.id', 'desc')
    ->get();

foreach ($jobs as $job) {
    $targetTime = Carbon::parse($job->target_date . ' ' . $job->target_time);
    $targetTime = $targetTime->addMinutes($job->time_target);
    $job->time_target = $targetTime->toDateTimeString();
}
        foreach ($jobs as $job) {
            $completedJobs = DB::table('jobs')
                ->where('id_booking', $job->id)
                ->where('status', '!=', 'Đã hoàn thành')
                ->count();

            if ($completedJobs == 0) {
                DB::table('booking')
                    ->where('id', $job->id)
                    ->update(['status' => 'Đã xong']);
            }
        }
        return view('admin/pages/jobs/jobs', compact('jobs'));
    }
    public function jobDetail($id)
    {

        $jobDetail = DB::table('jobs')
            ->where('id_booking', '=', $id)
            ->get();
        $nameStaff = DB::table('booking')
        ->join('staff', 'booking.id_staff', 'staff.id')
        ->join('users', 'users.id', 'staff.id_user')
        ->select('users.name')
        ->where('booking.id', $id)
        ->first();
        $idBooking = $id;
        return view('admin/pages/jobs/jobDetail', compact('jobDetail','idBooking', 'nameStaff'));
    }
    public function startJob(Request $request)
    {
        
        $bookingId = $request->input('bookingId');
        $userId = session('id');
        $content = "Bắt đầu làm";
        DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insert([
                'user_id' => $userId,
                'content' => $content,
                'booking_id'=>$bookingId
            ]);
        $staffId = $request->input('staffId');
        $roomId = $request->input('room');
       $saveStaffAndRoom =  DB::table('booking')
            ->where('id', $bookingId)
            ->update([
                'id_staff' => $staffId,
                'id_room' => $roomId,
                'status' => 'Đang làm',
            ]);
        if($saveStaffAndRoom){
            DB::table('room')
            ->where('id', $roomId)
            ->update(['status' => 'Đang làm']);
            DB::table('staff')
            ->where('id', $staffId)
            ->update(['status' => 'Đang làm']);
            DB::table('jobs')
            ->where('id_booking', $bookingId)
            ->update(['id_staff' => $staffId]);
        }
        DB::table('notification')->insert(['booking_id'=>$bookingId,'title' => 'Công việc','content' => 'Đã bắt đầu làm lịch của ','created_at' =>now()]);
            session()->flash('message', 'Lịch đã bắt đầu làm');
    }
    public function confirmComplete($id)
    {
        $status = 'Đã hoàn thành';
        $userId = session('id');
        $content = "Đã hoàn thành";
        DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insert([
                'user_id' => $userId,
                'content' => $content,
                'booking_id'=>$id
            ]);
        $booking = DB::table('booking')->where('id', $id)->first();
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        DB::table('staff')->where('id', $booking->id_staff)->update(['status' => 'Đang đợi việc']);
        DB::table('room')->where('id', $booking->id_room)->update(['status' => 'Đang trống']);
        DB::table('booking')->where('id', $id)->update(['status_bill' => 'Chưa tạo hóa đơn']);
        return redirect()->back()->with('message', 'Xác nhận lịch đã hoàn thành');
    }
    public function viewAddJob($id)
    {
        $jobs = DB::table('service_items')
            ->where('item_name', 'LIKE', 'Thay%')
            ->orWhere('id_service', '=', NULL)
            ->get();
        return view('admin/pages/jobs/addJob', compact('jobs', 'id'));
    }
    public function addJob(Request $request)
    {
        $data = $request->validate([
            'service_item' => 'required',
            'note' => 'required',
            'id' => 'required'
        ]);

        $id = $data['id'];
        $idStaff = DB::table('booking')
        ->select('id_staff')
        ->where('id', $id)
        ->first();
        $infoService = DB::table('service_items')
            ->select('item_name', 'time_done', 'price')
            ->where('id', $data['service_item'])
            ->first();

        $addJob = DB::table('jobs')
            ->insert(
                [
                    'id_booking' => $data['id'],
                    'item_name' => $infoService->item_name,
                    'target_time_done' => $infoService->time_done,
                    'item_price' => $infoService->price,
                    'price' => $infoService->price,
                    'note' => $data['note'],
                    'id_staff' => $idStaff->id_staff,
                    'status' => "Đang chờ nhận việc"
                ]
            );
        return redirect()->route('jobs.detail', ['id' => $id])->with('message', 'Thêm thành công dịch vụ');
    }
    public function deleteJob(Request $request)
    {
            $jobIds = $request->input('job_id', []); 
            DB::table('jobs')
                ->whereIn('id', $jobIds)
                ->delete();
        
            return redirect()->back()->with('message', 'Xóa công việc thành công');
        }
    }
