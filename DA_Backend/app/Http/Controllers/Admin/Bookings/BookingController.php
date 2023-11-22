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
        $status = 'Đang đợi khách đến';
        DB::table('booking')->where('id', $id)->update(['status' => $status,'admin_name' => session('user_name'),'confirmed_at' => now()]);
        return redirect()->back()->with('message','Xác nhận lịch thành công');
    }
    public function restore($id)
    {
        $status = 'Chờ xác nhận';
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with('message','Khôi phục lịch thành công');
    }
    public function revoke($id)
    {
        $status = 'Đã được hủy';
        DB::table('booking')->where('id', $id)->update(['status' => $status ,'admin_name' => session('user_name'),'canceled_at' => now()]);
        return redirect()->back()->with('error','Hủy lịch thành công');
    }
    public function bookingWait()
    {

        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('confirmed_at','admin_name','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('confirmed_at','admin_name','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đang đợi khách đến')
            ->get();
        return view('admin/pages/bookings/bookingWait', compact('bookings'));
    }
    public function getBookingWait($id)
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đang đợi khách đến')
            ->where('booking.id', '=', $id)
            ->get();
                return response()->json($bookings);
            }
    public function bookingCancel()
    {
            $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('canceled_at','admin_name','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('canceled_at','admin_name','booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đã được hủy')
            ->get();
            return view('admin/pages/bookings/bookingCancel', compact('bookings'));
    }
    public function getBookingCancel($id)
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đã được hủy')
            ->where('booking.id', '=', $id)
            ->get();
      
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

