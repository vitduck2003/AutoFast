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
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đang làm')
            ->get();

        return view('admin/pages/jobs/jobs', compact('jobs'));
    }
    public function jobDetail($id)
    {
        $jobDetail = DB::table('jobs')
        ->join('booking_detail', 'booking_detail.id_booking', '=', 'jobs.id_booking_detail')
        ->where('booking_detail.id_booking', '=', $id)
        ->select('jobs.*')
        ->get();  
        return view('admin/pages/jobs/jobDetail', compact('jobDetail'));
    }
}
