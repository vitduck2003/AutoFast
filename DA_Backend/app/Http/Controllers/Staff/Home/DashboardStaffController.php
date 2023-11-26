<?php

namespace App\Http\Controllers\Staff\Home;

use App\Models\Job;
use App\Models\User;
use App\Models\Staff;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardStaffController extends Controller
{
    public function staffIndex(){

        $waitingJobs = DB::table('jobs')
        ->where('status', 'LIKE', 'Đang chờ nhận việc')->count();

        $doingJobs = DB::table('jobs')
        ->where('status', 'LIKE', 'Đang làm')->count();

        $completeJobs = DB::table('jobs')
        ->where('status', 'LIKE', 'Đã hoàn thành')->count();

        $repairPrice = DB::table('jobs')
        ->sum('price');
        return view('staff/pages/home/staffHome', compact('waitingJobs', 'doingJobs', 'completeJobs', 'repairPrice'));
    }
}