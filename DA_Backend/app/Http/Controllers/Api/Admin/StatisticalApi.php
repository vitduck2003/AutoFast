<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatisticalApi extends Controller
{
    public function getBookingStats()
{
    $dailyStats = DB::table('booking')
    ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('DAY(created_at) as day'), DB::raw('COUNT(*) as count'))
    ->groupBy('year', 'month', 'day')
    ->get();
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
        ->get()
        ->toArray();
        return response()->json([
            'weeklyStats' => $weeklyStats,
            'monthlyStats' => $monthlyStats,
            'dailyStats' => $dailyStats,
            'yearlyStats' => $yearlyStats
        ]);
}
}
