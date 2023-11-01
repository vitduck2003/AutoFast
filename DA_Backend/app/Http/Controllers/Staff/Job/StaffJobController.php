<?php

namespace App\Http\Controllers\Staff\Job;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StaffJobController extends Controller
{
    public function currentJob(){
        $staff = DB::table('staff')
        ->where('id', '=', User::user()->phone)
        ->first();
        $jobs = DB::table('jobs')
        ->where('id', '=', $staff->id)
        ->where('status', 'LIKE', "Đang làm")
        ->get();    
        return view('staff.pages.jobs.currentJob', compact('jobs'));
    }
}
