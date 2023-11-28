<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $user_id = session('id');
        $notifications = DB::table('notification')
            ->join('booking', 'booking.id', '=', 'notification.booking_id')
            ->select('notification.*', 'booking.name')
            ->orderBy('notification.created_at', 'desc')    
            ->paginate(10);
        return view('admin/pages/notification/index', compact('notifications'));
    }
    public function home()
    {
        $user_id = session('id');

        $notifications = DB::table('notification')
            ->join('booking', 'booking.id', '=', 'notification.booking_id')
            ->select('notification.*', 'booking.name')
            ->orderBy('notification.created_at', 'desc')
            ->get();
        
        $currentTime = Carbon::now();
        
        foreach ($notifications as $notification) {
            $createdTime = Carbon::parse($notification->created_at);
        
            if ($currentTime->diffInMinutes($createdTime) >= 60) {
                $displayTime = $createdTime->diffInHours($currentTime) . ' giờ trước';
            } else {
                $displayTime = $createdTime->diffInMinutes($currentTime) . ' phút trước';
            }
        
            $notification->display_time = $displayTime;
        }
        
        return response()->json($notifications);
    }
}
