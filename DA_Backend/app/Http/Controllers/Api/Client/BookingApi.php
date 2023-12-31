<?php

namespace App\Http\Controllers\Api\Client;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class BookingApi extends Controller
{
    public function booking(Request $request)
    {
        $data = $request->all();
        $bookingId = DB::table('booking')->insertGetId([
            'name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'user_id' => $data['user_id'] ? $data['user_id'] : null,
            'target_date' => $data['target_date'],
            'target_time' => $data['target_time'],
            'model_car' => $data['model_car'],
            'license_plate' => $data['bsx'],
            'mileage' => $data['mileage'],
            'note' => $data['note'] ? $data['note'] : null,
            'total_price' => $data['TotalPrice'],
            'status' => $data['status'],
            'created_at' => Carbon::now()
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
                    $jobId = DB::table('jobs')->insertGetId([
                        'id_booking' => $bookingId,
                        'id_booking_detail' => $bookingDetailId,
                        'id_service' => $itemService->id_service,
                        'item_name' => $itemService->item_name,
                        'license_plate' => $data['bsx'],
                        'item_price' => $itemService->price,
                        'target_time_done' => $itemService->time_done,
                        'images_done' => null,
                        'price' => $itemService->price,
                        'status' => 'Đang chờ nhận việc',
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
                                'license_plate' => $data['bsx'],
                                'target_time_done' => $itemServiceOther->time_done,
                                'images_done' => null,
                                'price' => $itemServiceOther->price,
                                'status' => 'Đang chờ nhận việc',
                                'note' => 'Dịch vụ thêm'
                            ]);
                        }
                    }
             //send mailer
             DB::table('notification')->insert(['booking_id'=>$bookingId,'title' => 'Công việc','content' => 'Có lịch bảo dưỡng mới của','created_at' =>now()]);

              $mail = new MailController();

              $data_service = DB::table('jobs')->select('item_name','item_price')->where('id_booking',$bookingId)->get();
           
              $nameservice = DB::table('booking_detail')
              ->join('services','services.id','=','booking_detail.id_service')
              ->where('booking_detail.id_service','=',$data['service'])
              ->select('services.service_name')->first();

              $userdata = [
                'name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'user_id' => $data['user_id'] ? $data['user_id'] : null,
                'target_date' => $data['target_date'],
                'target_time' => $data['target_time'],
                'model_car' => $data['model_car'],
                'mileage' => $data['mileage'],
                'note' => $data['note'] ? $data['note'] : null,
                'total_price' => $data['TotalPrice'],
                'status' => $data['status'],
                'serice_item'=>$data_service,
                'service_name'=>$nameservice->service_name
              ];
           
          
              $mail->xac_nhan_dat_lich($userdata);
            
              
                return response()->json([
                    'message' => 'Đặt lịch thành công', 
                    'success' => true,
                    
                ], 200);
            } else {
                return response()->json(['message' => 'Lỗi khi thêm chi tiết đặt lịch',   'success' => false,], 500);
            }
        } else {
            return response()->json(['message' => 'Lỗi khi tạo đặt lịch',   'success' => false,], 500);
        }
    }
    public function getBookingUser(Request $request){
        $user_id = $request->input('user_id');
        $bookings = DB::table('booking')
        ->leftJoin('jobs', 'booking.id', '=', 'jobs.id_booking')
        ->leftJoin('staff', 'jobs.id_staff', '=', 'staff.id')
        ->leftJoin('users', 'users.id', '=', 'staff.id_user')
        ->leftJoin('booking_detail', 'booking_detail.id_booking', '=', 'booking.id')
        ->leftJoin('services', 'services.id', '=', 'booking_detail.id_service')
        ->leftJoin('bill', 'bill.id_booking', '=', 'booking.id')
        ->leftJoin('room', 'room.id', 'booking.id_room')
        ->select('booking.*', 'jobs.*', 'jobs.status as job_status', 'booking.status as booking_status', 'users.name as staff_name', 'services.service_name', 'bill.total_amount', 'room.name as room_name')
        ->where('booking.user_id', '=', $user_id)
        ->get();
        $result = [];
        foreach ($bookings as $booking) {
            $bookingId = $booking->id_booking;
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
                        'room' => $booking->room_name,
                        'created_at' => $booking->created_at,
                    ],
                    'jobs' => [],
                ];
            }
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
    public function getBookingPaymentPhone(Request $request){
        $user_id = $request->input('user_id');
        $bookings = DB::table('bill')
        ->leftJoin('booking', 'bill.id_booking', 'booking.id')
        ->leftJoin('jobs', 'booking.id', '=', 'jobs.id_booking')
        ->leftJoin('staff', 'jobs.id_staff', '=', 'staff.id')
        ->leftJoin('users', 'users.id', '=', 'staff.id_user')
        ->leftJoin('booking_detail', 'booking_detail.id_booking', '=', 'booking.id')
        ->leftJoin('services', 'services.id', '=', 'booking_detail.id_service')
        ->select('booking.*', 'jobs.*', 'jobs.status as job_status', 'booking.status as booking_status', 'users.name as staff_name', 'services.service_name', 'bill.total_amount', 'bill.status_payment')
        ->where('booking.user_id', '=', $user_id)
        ->get();
        $result = [];
        foreach ($bookings as $booking) {
            $bookingId = $booking->id_booking;
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
                        'status_payment' => $booking->status_payment,
                        'created_at' => $booking->created_at
                    ],
                    'jobs' => [],
                ];
            }
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
    public function cancelBooking(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
       return response()->json([
        'message' => 'Hủy lịch thành công', 
        'success' => true,
       ], 200);
    }

    public function checkTime(Request $request){
        $target_date = $request->input('target_date');
     
    $checktime = DB::table('booking')
        ->select(
            DB::raw('SUM(CASE WHEN `target_time` = "08:00:00" THEN 1 ELSE 0 END) AS `08:00:00`'),
            DB::raw('SUM(CASE WHEN `target_time` = "10:00:00" THEN 1 ELSE 0 END) AS `10:00:00`'),
            DB::raw('SUM(CASE WHEN `target_time` = "13:00:00" THEN 1 ELSE 0 END) AS `13:00:00`'),
            DB::raw('SUM(CASE WHEN `target_time` = "15:00:00" THEN 1 ELSE 0 END) AS `15:00:00`'),
            DB::raw('SUM(CASE WHEN `target_time` = "17:00:00" THEN 1 ELSE 0 END) AS `17:00:00`')
        )
        ->where('target_date', $target_date)
        ->where('status', '!=', 'Đã được hủy')
        ->where('status', '!=', 'Đã hoàn thành')
        ->get();
    
        $fullhour = [];
        foreach ($checktime[0] as $key => $value) {
            if ($value > 3) {
                $fullhour[] = $key;
            }
        }
        if($fullhour){
            return response()->json($fullhour);
        }else{
            return response()->json($fullhour);
        }
    }

    }
 
   