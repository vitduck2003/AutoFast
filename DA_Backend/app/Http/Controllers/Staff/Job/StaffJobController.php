<?php

namespace App\Http\Controllers\Staff\Job;

use App\Models\Job;
use App\Models\User;
use App\Models\Staff;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StaffJobController extends Controller
{
    // public function index(){
    //     $total_staff = Staff::where('status', 'LIKE', 'Đã xong');
    //     return view('staff.pages.index', compact('total_staff'));
    // }
    public function currentJob(){
        $phone = session('phone');
        $user = User::where('phone', $phone)->first();
        $staff = Staff::where('id_user', $user->id)->first();
        $jobs = DB::table('jobs')
            ->where('id_staff', $staff->id)
            ->where('status', 'LIKE', 'Đang chờ nhận việc')
            ->orWhere('status', 'LIKE', 'Đang làm')
            ->orWhere('status', 'LIKE', 'Đã xong')
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

        $total = DB::table('jobs')
        ->where('status', 'LIKE', 'Đang chờ nhận việc')->count();

        $total1 = DB::table('jobs')
        ->where('status', 'LIKE', 'Đang làm')->count();

        $total2 = DB::table('jobs')
        ->where('status', 'LIKE', 'Đã hoàn thành')->count();

        $total3 = DB::table('jobs')
        ->sum('price');
        return view('staff/pages/jobs/currentJob', compact('jobs', 'total', 'total1', 'total2', 'total3'));


    }
    public function startJob(Request $request)
{
    $jobId = $request->input('job_id');
    $job = Job::find($jobId);

    if ($job) {
        $job->status = 'Đang làm';
        $job->save();
    }
    return redirect()->back();
}
    public function jobDone(Request $request)
{
    $jobId = $request->input('job_id');
    $job = Job::find($jobId);

    if ($job) {
        $job->status = 'Đã hoàn thành';
        $job->save();
    }
    return redirect()->back();
}
public function jobComplete(){
    $phone = session('phone');
    $user = User::where('phone', $phone)->first();
    $staff = Staff::where('id_user', $user->id)->first();
    $jobs = DB::table('jobs')
        ->where('id_staff', $staff->id)
        ->where('status', 'LIKE', 'Đã hoàn thành')
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
