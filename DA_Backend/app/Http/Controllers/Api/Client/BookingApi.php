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
}
