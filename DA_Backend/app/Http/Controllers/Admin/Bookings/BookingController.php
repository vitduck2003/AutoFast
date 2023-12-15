<?php

namespace App\Http\Controllers\Admin\Bookings;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name')
            ->where('booking.status', 'LIKE', 'Chờ xác nhận')
            ->orderBy('booking.id', 'desc')
            ->get();
        // return response()->json($bookings);
        return view('admin/pages/bookings/bookings', compact('bookings'));
    }
    public function getBooking($id)
    {
        // Lấy thông tin booking từ bảng 'booking' dựa trên ID
        $booking = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name')
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
        $content = "Xác nhận";
        $status = 'Đang đợi khách đến';
        DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insert([
                'user_id' => $userId,
                'content' => $content,
                'booking_id' => $id
            ]);
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        //mail
        $databk = DB::table('booking')->where('id', $id)->get();
        $data = $databk[0];

        $data_service = DB::table('jobs')
            ->select('item_name', 'item_price', 'service_name')
            ->join('services', 'services.id', '=', 'jobs.id_service')
            ->where('id_booking', $data->id)->get();
        $userdata = [
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'target_date' => $data->target_date ? $data->target_date : 'trống',
            'target_time' => $data->target_time ?  $data->target_time : 'trống',
            'model_car' => $data->model_car ? $data->model_car : 'trống',
            'mileage' => $data->mileage ? $data->mileage : 'trống',
            'note' => $data->note ? $data->note : 'trống',
            'total_price' => $data->total_price,

            'serice_item' => $data_service,
            'service_name' => $data_service[0]->service_name
        ];

        try {
            $mail = new MailController();
            $mail->lich_dat_thanh_cong($userdata);
        } catch (\Exception $e) {
        }
        return redirect()->back()->with('message', 'Xác nhận lịch thành công');
    }
    public function restore($id)
    {
        $status = 'Chờ xác nhận';
        $userId = session('id');
        $content = "Khôi phục";
        DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insert([
                'user_id' => $userId,
                'content' => $content,
                'booking_id' => $id
            ]);
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with('message', 'Khôi phục lịch thành công');
    }
    public function revoke($id)
    {
        $status = 'Đã được hủy';
        $userId = session('id');
        $content = "Hủy";
        DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insert([
                'user_id' => $userId,
                'content' => $content,
                'booking_id' => $id
            ]);
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        DB::table('notification')->insert(['booking_id' => $id, 'title' => 'Công việc', 'content' => 'Đã hủy lịch bảo dưỡng của ', 'created_at' => now()]);
        return redirect()->back()->with('error', 'Hủy lịch thành công');
    }
    public function bookingWait()
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name')
            ->where('booking.status', 'LIKE', 'Đang đợi khách đến')
            ->orderBy('booking.id', 'desc')
            ->get();
        $checkRoom = DB::table('room')
            ->where('status', 'Đang trống')
            ->count();
        $checkStaff = DB::table('staff')
            ->where('status', 'Đang đợi việc')
            ->count();
        $checkBookingPrio = DB::table('booking')
        ->where('status', "Lịch ưu tiên")
        ->count();
        return view('admin/pages/bookings/bookingWait', compact('bookings', 'checkRoom', 'checkStaff', 'checkBookingPrio'));
    }
    public function getBookingWait($id)
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', 'booking.log_id', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', 'booking.log_id')
            ->where('booking.status', 'LIKE', 'Đang đợi khách đến')
            ->where('booking.id', '=', $id)
            ->get();
        foreach ($bookings as $booking) {
            $booking->logs = DB::table('log')
                ->join('users', 'users.id', '=', 'log.user_id')
                ->where('log.id', $booking->log_id)
                ->select('users.name as admin_name', 'confirmed_at')
                ->get();
        }
        return response()->json($bookings);
    }
    public function bookingPriority()
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name')
            ->where('booking.status', 'LIKE', 'Lịch ưu tiên')
            ->orderBy('booking.id', 'desc')
            ->get();
        $checkRoom = DB::table('room')
            ->where('status', 'Đang trống')
            ->count();
        $checkStaff = DB::table('staff')
            ->where('status', 'Đang đợi việc')
            ->count();
        return view('admin/pages/bookings/bookingPriority', compact('bookings', 'checkRoom', 'checkStaff'));
    }
    public function getBookingPriority($id)
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', 'booking.log_id', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', 'booking.log_id')
            ->where('booking.status', 'LIKE', 'Lịch ưu tiên')
            ->where('booking.id', '=', $id)
            ->get();
        return response()->json($bookings);
    }
    public function priority(Request $request)
    {
        $data = $request->all();
        $id = $data['idBooking'];
        $userId = session('id');
        $content = "Chuyển đến lịch ưu tiên";
        DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->insert([
                'user_id' => $userId,
                'content' => $content,
                'booking_id' => $id
            ]);
        $status = 'Lịch ưu tiên';
        DB::table('booking')->where('id', $id)->update(['status' => $status]);
        DB::table('notification')->insert(['booking_id' => $id, 'title' => 'Công việc', 'content' => 'Lịch bảo dưỡng đặc biệt ưu tiên cho khách hàng ', 'created_at' => now()]);
        return redirect()->back()->with('message', 'Đã chuyển sang ưu tiên hoặc không có phòng');
    }
    public function bookingCancel()
    {
        $bookings = DB::table('booking')
            ->join('jobs', 'booking.id', '=', 'jobs.id_booking')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note')
            ->where('booking.status', 'LIKE', 'Đã được hủy')
            ->orderBy('booking.id', 'desc')
            ->get();

        return view('admin/pages/bookings/bookingCancel', compact('bookings'));
    }
    public function getBookingCancel($id)
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', 'booking.log_id', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', 'booking.log_id')
            ->where('booking.status', 'LIKE', 'Đã được hủy')
            ->where('booking.id', '=', $id)
            ->get();
        foreach ($bookings as $booking) {
            $booking->logs = DB::table('log')
                ->join('users', 'users.id', '=', 'log.user_id')
                ->where('log.id', $booking->log_id)
                ->select('users.name as admin_name', 'canceled_at')
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
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'booking.status_bill', 'booking.discount', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'booking.status_bill', 'booking.discount')
            ->where('booking.status', 'LIKE', 'Đã hoàn thành')
            ->orderBy('booking.id', 'desc')
            ->get();
        foreach ($bookings as $value) {

            if ($value->discount) {
                $value->total_discount = ($value->discount / 100) * $value->total_prices;
                $value->total_prices = $value->total_prices - $value->total_discount;
            } else {
                $value->total_discount = 0;
            }
        }

        return view('admin/pages/bookings/bookingComplete', compact('bookings'));
    }
    public function getBookingComplete($id)
    {
        $bookings = DB::table('booking')
            ->join('booking_detail', 'booking.id', '=', 'booking_detail.id_booking')
            ->join('jobs', 'booking_detail.id', '=', 'jobs.id_booking_detail')
            ->join('services', 'booking_detail.id_service', '=', 'services.id')
            ->select('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'booking.discount', 'services.service_name', DB::raw('GROUP_CONCAT(jobs.item_name) as item_names'), DB::raw('GROUP_CONCAT(jobs.item_price) as item_prices'), DB::raw('sum(jobs.item_price) as total_prices'))
            ->groupBy('booking.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'booking.target_date', 'booking.target_time', 'booking.status', 'booking.note', 'services.service_name', 'booking.discount')
            ->where('booking.status', 'LIKE', 'Đã hoàn thành')
            ->where('booking.id', '=', $id)
            ->get();

        return response()->json($bookings);
    }
    public function getBookingDetail()
    {
        $bookingDetail = DB::table('booking_detail')
            // ->join('booking', 'booking.id', '=', 'booking_detail.id_booking')
            // ->join('services', 'services.id', '=', 'booking_detail.id_service')
            // ->select('booking_detail.id','booking.*','services.*')
            ->get();
        return response()->json($bookingDetail);
    }
    public function bookingDetail($id)
    {
        $booking = DB::table('booking')
            ->select('id', 'name', 'phone', 'email', 'target_date', 'target_time', 'note', 'status', 'total_price', 'model_car', 'mileage',  'created_at')
            ->where('id', $id)
            ->first();
        $service = DB::table('booking_detail')
            ->join('services', 'services.id', 'booking_detail.id_service')
            ->select('services.service_name')
            ->where('booking_detail.id_booking', $id)
            ->first();
        $jobs = DB::table('jobs')
            ->select('id', 'item_name', 'item_price', 'target_time_done', 'note')
            ->where('id_booking', $booking->id)
            ->get();
        $total_price = DB::table('jobs')
            ->select(DB::raw('sum(item_price) as total_price'))
            ->where('id_booking', $booking->id)
            ->first();
        DB::table('booking')
            ->where('id', $id)
            ->update(['total_price' => $total_price->total_price]);
        $logs = DB::table('log')
            ->join('users', 'users.id', '=', 'log.user_id')
            ->where('log.booking_id', $id)
            ->select('users.name as admin_name', 'log.content', 'log.created_at')
            ->get();
        return view('admin/pages/bookings/bookingDetail', compact('booking', 'jobs', 'service', 'logs', 'total_price'));
    }
    public function getRoom()
    {
        $rooms = DB::table('room')
            ->select('id', 'name')
            ->where('status', 'Đang trống')
            ->get();
        return response()->json($rooms);
    }
    public function getStaff()
    {
        $staffs = DB::table('staff')
            ->join('users', 'users.id', 'staff.id_user')
            ->select('staff.id', 'users.name')
            ->where('status', 'Đang đợi việc')
            ->get();
        return response()->json($staffs);
    }
    public function deleteJob($id)
    {
        DB::table('jobs')
            ->where('id', $id)
            ->delete();
        return redirect()->back()->with('message', 'Xóa công việc thành công');
    }

    public function bookingEditView($id)
    {
        $booking = DB::table('booking')
            ->where('id', $id)
            ->first();
        $services = DB::table('services')
            ->select('id', 'service_name')
            ->get();
        $service_present = DB::table('booking_detail')
            ->join('services', 'booking_detail.id_service', 'services.id')
            ->select('services.id', 'services.service_name')
            ->where('id_booking', $id)
            ->first();
        $service_items_other = DB::table('service_items')
            ->where('id_service', NULL)
            ->select('id', 'item_name')
            ->get();
        $service_items_other_present = DB::table('jobs')
            ->select('item_name', 'note')
            ->where('note', '=', 'Dịch vụ thêm')
            ->where('id_booking', '=', $id)
            ->get();
        return view('admin/pages/bookings/bookingEdit', compact('booking', 'services', 'service_present', 'service_items_other', 'service_items_other_present'));
    }
    public function bookingEdit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'model_car' => 'required',
            'mileage' => 'required|numeric',
            'target_date' => [
                'required',
                'date',
                Rule::notIn([Carbon::yesterday()->toDateString()]),
            ],
        ]);
        $data = $request->except('_token');
        $check_service = DB::table('booking_detail')
            ->select('id_service', 'id')
            ->where('id_booking', '=', $data['id_booking'])
            ->first();
        $booking_update = DB::table('booking')
            ->where('id', '=', $data['id_booking'])
            ->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'model_car' => $data['model_car'],
                'target_time' => $data['target_time'],
                'target_date' => $data['target_date'],
                'mileage' => $data['mileage'],
            ]);
        if ($check_service->id_service != $data['service']) {
            DB::table('booking_detail')
                ->where('id_booking', $data['id_booking'])
                ->update(['id_service' => $data['service']]);
            DB::table('jobs')
                ->where('id_booking', $data['id_booking'])
                ->delete();
            $itemServices = DB::table('service_items')
                ->where('id_service', $data['service'])
                ->get();

            foreach ($itemServices as $itemService) {
                $jobId = DB::table('jobs')->insertGetId([
                    'id_booking' => $data['id_booking'],
                    'id_booking_detail' => $check_service->id,
                    'id_service' => $itemService->id_service,
                    'item_name' => $itemService->item_name,
                    'item_price' => $itemService->price,
                    'target_time_done' => $itemService->time_done,
                    'images_done' => null,
                    'price' => $itemService->price,
                    'status' => 'Đang chờ nhận việc',
                ]);
            }
        }
        if (is_null($data['service_other'][0])) {
            DB::table('jobs')
                ->where('id_booking', $data['id_booking'])
                ->where('id_service', NULL)
                ->delete();
        } else {
            DB::table('jobs')
            ->where('id_booking', $data['id_booking'])
            ->where('id_service', NULL)
            ->delete();
            foreach ($data['service_other'] as $id_other) {
                $itemServiceOther = DB::table('service_items')
                    ->where('id', '=', $id_other)
                    ->first();
                if ($itemServiceOther) {
                    $jobId = DB::table('jobs')->insertGetId([
                        'id_booking' => $data['id_booking'],
                        'id_booking_detail' => $check_service->id,
                        'id_service' => null,
                        'item_name' => $itemServiceOther->item_name,
                        'item_price' => $itemServiceOther->price,
                        'target_time_done' => $itemServiceOther->time_done,
                        'images_done' => null,
                        'price' => $itemServiceOther->price,
                        'status' => 'Đang chờ nhận việc',
                        'note' => 'Dịch vụ thêm'
                    ]);
                }
            }
        }
        return redirect()->back()->with('message', 'Sửa lịch thành công');
    }
}
