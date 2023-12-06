<?php

namespace App\Http\Controllers\Admin\Layout;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class LayoutController extends Controller
{
    public function admin()
    {
        $bookingPending = DB::table('booking')
            ->where('status', "Chờ xác nhận")
            ->count();
        $bookingWait = DB::table('booking')
            ->where('status', "Đang đợi khách đến")
            ->count();
        $bookingCancel = DB::table('booking')
            ->where('status', "Đã được hủy")
            ->count();
        $bookingComplete = DB::table('booking')
            ->where('status', "Chờ xác nhận")
            ->count();
        $bookingPrio = DB::table('booking')
            ->where('status', "Lịch ưu tiên")
            ->count();
        $bookingDoing = DB::table('booking')
            ->where('status', "Đang làm")
            ->count();
            $data = [
                'bookingPending' => $bookingPending,
                'bookingWait' => $bookingWait,
                'bookingCancel' => $bookingCancel,
                'bookingComplete' => $bookingComplete,
                'bookingPrio' => $bookingPrio,
                'bookingDoing' => $bookingDoing
            ];
            return response()->json($data);
    }
}
