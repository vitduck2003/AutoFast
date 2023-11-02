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
    public function currentJob(){
        $phone = session('phone');
        $user = User::where('phone', $phone)->first();
        $staff = Staff::where('id_user', $user->id)->first();
        $jobs = DB::table('jobs')
            ->where('id_staff', $staff->id)
            ->where('status', 'LIKE', 'Đang làm')
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
    public function updateJobStatus(Request $request)
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
