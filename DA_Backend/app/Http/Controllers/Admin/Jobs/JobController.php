<?php

namespace App\Http\Controllers\Admin\Jobs;

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
        ->where('status', 'LIKE', 'Đang đợi việc')
        ->get();
        $jobDetail = DB::table('jobs')
            ->where('id_booking', '=', $id)
            ->get();
        return view('admin/pages/jobs/jobDetail', compact('jobDetail', 'staffs_free_time'));
    }
    public function startJob($id)
    {
        $status = 'Đang làm';
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        return redirect()->back();
    }
    public function confirmComplete($id){
        $status = 'Đã hoàn thành';
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        return redirect()->back();
    }
}
