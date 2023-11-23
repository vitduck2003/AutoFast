<?php

namespace App\Http\Controllers\Admin\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $totalBookings = DB::table('booking')->count();
        $totalBills = DB::table('bill')->count();
        $totalRevenue = DB::table('bill')->where('status_payment', 'Đã thanh toán')->sum('total_amount');

        $currentDate = date('Y-m-d');
        $allBookingToday = DB::table('booking')
        ->whereDate('created_at', $currentDate)
        ->count();
        $bookingCompleteToday = DB::table('booking')
        ->whereDate('created_at', $currentDate)
        ->where('status', 'Đã hoàn thành')
        ->count();
        $bookingCancelToday = DB::table('booking')
        ->whereDate('created_at', $currentDate)
        ->where('status', 'Đã được hủy')
        ->count();
        // $currentMonth = date('m'); 
        // $bookingMonth = DB::table('booking')
        // ->whereMonth('created_at', $currentMonth)
        // ->count();

        // $currentYear = date('Y');
        // $bookingYear = DB::table('booking')
        // ->whereYear('created_at', $currentYear)
        // ->count();

        $weeklyStats = DB::table('booking')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('COUNT(*) as count'))
            ->groupBy('year', 'week')
            ->get();
    
        $monthlyStats = DB::table('booking')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->groupBy('year', 'month')
            ->get();
        $yearlyStats = DB::table('booking')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->groupBy('year')
            ->get();
        // dd( $bookingToday , $bookingMonth ,   $bookingYear);
        return view('admin.pages.index', compact(['allBookingToday', 'bookingCompleteToday', 'bookingCancelToday']));
    }
}
