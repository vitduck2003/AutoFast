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
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'target_date' => $data['target_date'],
            'target_time' => $data['target_time'],
            'name_car' => $data['name_car'],
            'note' => $data['note'],
            'status' => $data['status'],
        ]);

        if ($bookingId) {
            $bookingDetailId = DB::table('booking_details')->insertGetId([
                'id_booking' => $bookingId,
                'id_service' => $data['service'],
                'status' => 'Đang chờ xác nhận',
            ]);

            if ($bookingDetailId) {
                $itemServices = DB::table('item_service')->where('id_service', $data['service'])->get();

                foreach ($itemServices as $itemService) {
                    // Thực hiện insert vào bảng job
                    $jobId = DB::table('job')->insertGetId([
                        'id_booking_detail' => $bookingDetailId,
                        'id_service' => $itemService->id_service,
                        'item_name' => $itemService->item_name,
                        'item_price' => $itemService->price,
                        'id_staff' => null,
                        'target_time_done' => $itemService->time_done,
                        'images_done' => null,
                        'price' => $itemService->price,
                        'status' => 'Chờ xác nhận',
                    ]);
                }

                return response()->json(['message' => 'Đặt lịch thành công'], 200);
            } else {
                return response()->json(['message' => 'Lỗi khi thêm chi tiết đặt lịch'], 500);
            }
        } else {
            return response()->json(['message' => 'Lỗi khi tạo đặt lịch'], 500);
        }
    }
}
