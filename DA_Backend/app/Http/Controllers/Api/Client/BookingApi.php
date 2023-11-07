<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BookingApi extends Controller
{
    public function booking(Request $request)
    {
        $data = $request->all();
        $bookingId = DB::table('booking')->insertGetId([
            'name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'target_date' => $data['target_date'],
            'target_time' => $data['target_time'],
            'model_car' => $data['model_car'],
            'mileage' => $data['mileage'],
            'note' => $data['note'],
            'status' => $data['status'],
        ]);

        if ($bookingId) {
            $bookingDetailId = DB::table('booking_detail')->insertGetId([
                'id_booking' => $bookingId,
                'id_service' => $data['service'],
                'status' => 'Đang chờ xác nhận',
            ]);

            if ($bookingDetailId) {
                $itemServices = DB::table('service_items')
                    ->where('id_service', $data['service'])
                    ->get();

                foreach ($itemServices as $itemService) {
                    // Thực hiện insert vào bảng job
                    $jobId = DB::table('jobs')->insertGetId([
                        'id_booking' => $bookingId,
                        'id_booking_detail' => $bookingDetailId,
                        'id_service' => $itemService->id_service,
                        'item_name' => $itemService->item_name,
                        'item_price' => $itemService->price,
                        'id_staff' => null,
                        'target_time_done' => $itemService->time_done,
                        'images_done' => null,
                        'price' => $itemService->price,
                        'status' => 'Đang làm',
                    ]);
                }

                foreach ($data['service_item_other'] as $id_other) {
                    $itemServiceOther = DB::table('service_items')
                        ->where('id', '=', $id_other)
                        ->first();

                    if ($itemServiceOther) {
                        $jobId = DB::table('jobs')->insertGetId([
                            'id_booking' => $bookingId,
                            'id_booking_detail' => $bookingDetailId,
                            'id_service' => null,
                            'item_name' => $itemServiceOther->item_name,
                            'item_price' => $itemServiceOther->price,
                            'id_staff' => null,
                            'target_time_done' => $itemServiceOther->time_done,
                            'images_done' => null,
                            'price' => $itemServiceOther->price,
                            'status' => 'Đang làm',
                        ]);
                    }
                }

                return response()->json(['message' => 'Đặt lịch thành công'], 200);
            } else {
                return response()->json(['message' => 'Lỗi khi thêm chi tiết đặt lịch'], 500);
            }
        } else {
            return response()->json(['message' => 'Lỗi khi tạo đặt lịch'], 500);
        }
    }
    public function getBookingPhone(Request $request){
        $user_id = $request->input('user_id');
        $bookings = DB::table('booking')
        ->leftJoin('jobs', 'booking.id', '=', 'jobs.id_booking')
        ->leftJoin('staff', 'jobs.id_staff', '=', 'staff.id')
        ->leftJoin('users', 'users.id', '=', 'staff.id')
        ->leftJoin('booking_detail', 'booking_detail.id_booking', '=', 'booking.id')
        ->leftJoin('services', 'services.id', '=', 'booking_detail.id_service')
        ->leftJoin('bill', 'bill.id_booking', '=', 'booking.id')
        ->select('booking.*', 'jobs.*', 'jobs.status as job_status', 'booking.status as booking_status', 'users.name as staff_name', 'services.service_name', 'bill.total_amount')
        ->where('booking.phone', '=', $user_id)
        ->get();
        $result = [];
        foreach ($bookings as $booking) {
            $bookingId = $booking->id_booking;
            // Nếu booking chưa tồn tại trong mảng $result, tạo mới
            if (!isset($result[$bookingId])) {
                $result[$bookingId] = [
                    'booking' => [
                        'id' => $booking->id_booking,
                        'name' => $booking->name,
                        'phone' => $booking->phone,
                        'email' => $booking->email,
                        'service_name' => $booking->service_name,
                        'total_amount' => $booking->total_amount ? $booking->total_amount : "Chưa hoàn thành" ,
                        'target_date' => $booking->target_date,
                        'target_time' => $booking->target_time,
                        'note' => $booking->note,
                        'model_car' => $booking->model_car,
                        'mileage' => $booking->mileage,
                        'status' => $booking->booking_status,
                        'created_at' => $booking->created_at,
                    ],
                    'jobs' => [],
                ];
            }
            // Thêm thông tin job vào booking tương ứng
            $result[$bookingId]['jobs'][] = [
                'id' => $booking->id,
                'item_name' => $booking->item_name,
                'item_price' => $booking->item_price,
                'target_time_done' => $booking->target_time_done,
                'images_done' => $booking->images_done,
                'price' => $booking->price,
                'status' => $booking->job_status,
                "staff_name" =>  $booking->staff_name ? $booking->staff_name : 'Chưa nhận việc'
            ];
        }
    
        return response()->json([
            array_values($result)
        ]);
    }
}
