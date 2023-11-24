<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ManagerBookingApi extends Controller
{
    public function createBooking(Request $request)
    {
        // Lấy dữ liệu từ request
        $data = $request->all();
   
        // Thực hiện insert vào bảng 'booking'
        $bookingId = DB::table('booking')->insertGetId([
            'name' => $data['full_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'target_date' => $data['target_date'],
            'target_time' => $data['target_time'],
            'note' => $data['note'],
            'model_car' => $data['model_car'],
            'mileage' => $data['mileage'],
            'status' => $data['status'],
        ]);

        if ($bookingId) {
       
    
            // Thực hiện insert vào bảng 'booking_detail'
            $bookingDetailId = DB::table('booking_detail')->insertGetId([
               'booking_id' => $bookingId,
             'name' => $data['name'],
            'phone' => $data['phone'],
             'email' => $data['email'],
             'target_date' => $data['target_date'],
              'target_time' => $data['target_time'],
             'note' => $data['note'],
              'model_car' => $data['model_car'],
              'mileage' => $data['mileage'],
              'status' => $data['status'],
            ]);
            // Thực hiện insert vào bảng 'booking_detail'
            $bookingDetailId = DB::table('booking_detail')->insertGetId([
                'id_booking' => $bookingId,
                'id_service' => $data['service'],
                'status' => 'Đang chờ xác nhận',
            ]);

            if ($bookingDetailId) {
                // Lấy thông tin booking vừa tạo
                $booking = DB::table('booking')->where('id', $bookingId)->first();

                // Trả về thông tin booking
                return response()->json(['booking' => $booking], 200);
            } else {
                return response()->json(['message' => 'Lỗi khi thêm chi tiết đặt lịch'], 500);
            }
        } else {
            return response()->json(['message' => 'Lỗi khi tạo đặt lịch'], 500);
        }
    }

    public function getAllBookings()
    {
        // Lấy toàn bộ thông tin booking từ bảng 'booking'
        $bookings = DB::table('booking')->get();

        // Trả về danh sách booking
        return response()->json( $bookings, 200);
    }

    public function getBooking($id)
    {
        // Lấy thông tin booking từ bảng 'booking' dựa trên ID
        $booking = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('id_booking', '=', $id)
            ->get();

        if ($booking) {
            // Trả về thông tin booking
            return response()->json($booking);
        } else {
            return response()->json(['message' => 'Không tìm thấy đặt lịch'], 404);
        }
    }

    public function getBookingDetails()
    {
        // Lấy danh sách booking details từ bảng 'booking_detail' dựa trên ID booking
        $bookingDetails = DB::table('booking_detail')->get();

        // Trả về danh sách booking details
        return response()->json($bookingDetails, 200);
    }

    public function getJobs()
    {
        // Lấy danh sách jobs từ bảng 'jobs' dựa trên ID booking detail
        $jobs = DB::table('jobs')->get();

        // Trả về danh sách jobs
        return response()->json( $jobs, 200);
    }

public function confirmBooking($id)
{
    // Kiểm tra xem booking có tồn tại trong bảng 'booking' hay không
    $booking = DB::table('booking')->where('id', $id)->first();

    if ($booking) {
        // Cập nhật trạng thái của booking thành 'Đã xác nhận'
        DB::table('booking')->where('id', $id)->update(['status' => 'Đã xác nhận']);

        // Trả về thông báo xác nhận thành công
        return response()->json(['message' => 'Xác nhận đặt lịch thành công'], 200);
    } else {
        return response()->json(['message' => 'Không tìm thấy đặt lịch'], 404);
    }
}
public function cancelBooking($id)
{
    // Kiểm tra xem booking có tồn tại trong bảng 'booking' hay không
    $booking = DB::table('booking')->where('id', $id)->first();

    if ($booking) {
        // Cập nhật trạng thái của booking thành 'Đã xác nhận'
        DB::table('booking')->where('id', $id)->update(['status' => 'Đã hủy']);

        // Trả về thông báo xác nhận thành công
        return response()->json(['message' => 'Hủy đặt lịch thành công'], 200);
    } else {
        return response()->json(['message' => 'Không tìm thấy đặt lịch'], 404);
    }
}
}