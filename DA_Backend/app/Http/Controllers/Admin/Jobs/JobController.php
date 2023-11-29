<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index()
    {
        $jobs = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đang làm')
            ->orWhere('booking.status', 'LIKE', 'Đã xong')
            ->get();

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
        $staffs_free_time = DB::table('staff')
            ->join('users', 'users.id', '=', 'staff.id_user')
            ->select('staff.id', 'staff.status', 'users.name')
            ->where('status', 'LIKE', 'Đang đợi việc')
            ->get();
        $jobDetail = DB::table('jobs')
            ->where('id_booking', '=', $id)
            ->get();
        $idBooking = $id;
        return view('admin/pages/jobs/jobDetail', compact('jobDetail', 'staffs_free_time', 'idBooking'));
    }
    public function startJob($id)
    {
        $status = 'Đang làm';
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with('message', 'Lịch đã bắt đầu làm');
    }
    public function confirmComplete($id)
    {
        $status = 'Đã hoàn thành';
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with('message', 'Xác nhận lịch đã hoàn thành');
    }
    public function saveStaff(Request $request)
    {
        $jobIds = $request->input('job_id', []); // Sử dụng mảng rỗng làm giá trị mặc định nếu không có giá trị được chọn
        
        $staffIds = $request->input('staff_id', []);
        
        foreach ($jobIds as $jobId) {
            $staffId = $staffIds[$jobId] ?? null; // Sử dụng toán tử null coalescing để gán giá trị mặc định là null nếu không tồn tại $staffIds[$jobId]
        
            DB::table('jobs')
                ->where('id', $jobId)
                ->update(['id_staff' => $staffId]);
        
            $checkstaff = DB::table('jobs')
                ->where('id', $jobId)
                ->first();
        
            if ($checkstaff->id_staff == NULL) {
                $status = "Chưa phân công việc";
            } else {
                $status = "Đang chờ nhận việc";
            }
        
            DB::table('jobs')
                ->where('id', $jobId)
                ->update(['status' => $status]);
        }
        
        return redirect()->back()->with('message', 'Cập nhật nhân viên thành công');
    }
    public function viewAddJob($id){
        $jobs = DB::table('service_items')
        ->get();
        return view('admin/pages/jobs/addJob', compact('jobs', 'id'));
    }
    public function addJob(Request $request){
        $data = $request->validate([
            'service_item' => 'required',
            'note' => 'required',
            'id' => 'required'
        ]);
    
        $id = $data['id'];
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
                'status' => "Chưa phân công việc"
            ]
            );
            return redirect()->route('jobs.detail', ['id' => $id])->with('message', 'Thêm thành công dịch vụ');
    }
    public function deleteJob($id){
        $job = DB::table('jobs')->where('id',$id)->delete();
        return redirect()->back()->with('error', 'Xóa thành công dịch vụ');
    }
}

