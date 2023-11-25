<?php

namespace App\Http\Controllers\Api\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatisticalApi extends Controller
{
    public function getRevenue(Request $request, $option)
    {
        $revenue = 0;
        if ($option === 'today') {
            $revenue = DB::table('bill')
            ->whereDate('created_at', Carbon::today())
            ->where('status_payment', 'Đã thanh toán')
            ->sum('total_amount');
        } elseif ($option === 'week') {
            $revenue = DB::table('bill')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('status_payment', 'Đã thanh toán')
            ->sum('total_amount');
        } elseif ($option === 'month') {
            $revenue = DB::table('bill')
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('status_payment', 'Đã thanh toán')
            ->sum('total_amount');
        } elseif ($option === 'year') {
            $revenue = DB::table('bill')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status_payment', 'Đã thanh toán')
            ->sum('total_amount');
        }
        return response()->json(['revenue' => $revenue]);
    }
    
}
