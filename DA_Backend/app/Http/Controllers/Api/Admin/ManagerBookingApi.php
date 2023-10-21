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
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'target_date' => $data['target_date'],
            'target_time' => $data['target_time'],
            'note' => $data['note'],
            'name_car' => $data['name_car'],
            'status' => $data['status'],
        ]);

        if ($bookingId) {
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
        $booking = DB::table('booking')->where('id', $id)->first();

        if ($booking) {
            // Trả về thông tin booking
            return response()->json( $booking, 200);
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
}

