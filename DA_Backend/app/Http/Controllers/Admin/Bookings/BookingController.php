<?php

namespace App\Http\Controllers\Admin\Bookings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Chờ xác nhận')
            ->get();
        // return response()->json($bookings);
        return view('admin/pages/bookings/bookings', compact('bookings'));

    }
    public function getBooking($id)
    {
        // Lấy thông tin booking từ bảng 'booking' dựa trên ID
        $booking = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Chờ xác nhận')
            ->where('booking.id', '=', $id)
            ->get();
        if ($booking) {
            // Trả về thông tin booking
            return response()->json($booking);
        } else {
            return response()->json(['message' => 'Không tìm thấy đặt lịch'], 404);
        }
    }

    public function confirm($id)
    {
        $userId = session('id');
        $confirmedAt = now();
        $status = 'Đang đợi khách đến';
        $logId = DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insertGetId([
                'user_id' => $userId,
                'confirmed_at' => $confirmedAt,
            ]);
        DB::table('booking')->where('id', $id)->update(['log_id' => $logId,'status' => $status]);
            //mail
        return redirect()->back()->with('message', 'Xác nhận lịch thành công');
    }
    public function restore($id)
    {
        $status = 'Chờ xác nhận';
        $status = 'Chờ xác nhận';
        $logId = DB::table('booking')->where('id', $id)->value('log_id');
        DB::table('log')->where('id', $logId)->delete();
        DB::table('booking')->where('id', $id)->update(['log_id' => null,'status' => $status]);
        return redirect()->back()->with('message', 'Khôi phục lịch thành công');
    }
    public function revoke($id)
    {
        $status = 'Đã được hủy';
        $userId = session('id');
        $CanceledAt = now();
        $logId = DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insertGetId([
                'user_id' => $userId,
                'canceled_at' => $CanceledAt,
            ]);
        DB::table('booking')->where('id', $id)->update(['log_id' => $logId,'status' => $status]);
        return redirect()->back()->with('error', 'Hủy lịch thành công');
    }
    public function bookingWait()
    {

        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('log_id','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('log_id','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đang đợi khách đến')
            ->get();
        return view('admin/pages/bookings/bookingWait', compact('bookings'));
    }
    public function getBookingWait($id)
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('log_id','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('log_id','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đang đợi khách đến')
            ->where('booking.id', '=', $id)
            ->get();
            foreach ($bookings as $booking) {
                $booking->logs = DB::table('log')
                ->join('users', 'users.id','=','log.user_id')
                ->where('log.id', $booking->log_id)
                ->select('users.name as admin_name','confirmed_at')
                ->get();
            }
        return response()->json($bookings);
    }
    public function bookingCancel()
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đã được hủy')
            ->get();
            
        return view('admin/pages/bookings/bookingCancel', compact('bookings'));
    }
    public function getBookingCancel($id)
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('log_id','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('log_id','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đã được hủy')
            ->where('booking.id', '=', $id)
            ->get();
            foreach ($bookings as $booking) {
                $booking->logs = DB::table('log')
                ->join('users', 'users.id','=','log.user_id')
                ->where('log.id', $booking->log_id)
                ->select('users.name as admin_name','canceled_at')
                ->get();
            }
        if ($bookings) {
            // Trả về thông tin booking
            return response()->json($bookings);
        } else {
            return response()->json(['message' => 'Không tìm thấy đặt lịch'], 404);
        }
    }
    public function bookingComplete()
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đã hoàn thành')
            ->get();
        //   dd($bookings);
        return view('admin/pages/bookings/bookingComplete', compact('bookings'));
    }
    public function getBookingComplete($id)
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đã hoàn thành')
            ->where('booking.id', '=', $id)
            ->get();
        return response()->json($bookings);
    }
}

