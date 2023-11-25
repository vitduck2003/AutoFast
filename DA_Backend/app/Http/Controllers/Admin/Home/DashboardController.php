<?php

namespace App\Http\Controllers\Admin\Home;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $currentDate = date('Y-m-d');
        $allBookingToday = DB::table('booking')
            ->whereDate('created_at', $currentDate)
            ->count();
        $bookingCompleteToday = DB::table('booking')
            ->whereDate('created_at', $currentDate)
            ->where('status', 'Đã hoàn thành')
            ->count();
        $bookingCancelToday = DB::table('booking')
            ->whereDate('created_at', $currentDate)
            ->where('status', 'Đã được hủy')
            ->count();
        $currentDate = Carbon::today();
        $monday = $currentDate->copy()->startOfWeek();
        $sunday = $currentDate->copy()->endOfWeek();

        // Truy vấn lịch đã đặt trong tuần
        $bookings = DB::table('booking')
            ->whereBetween('created_at', [$monday, $sunday])
            ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS count'))
            ->groupBy('date')
            ->get();

        $bookingCounts = [];
        $completedBookingCounts = [];
        $cancelledBookingCounts = [];

        foreach ($bookings as $booking) {
            $bookingCounts[$booking->date] = $booking->count;
        }

        // Truy vấn lịch đã hoàn thành trong tuần
        $completedBookings = DB::table('booking')
            ->whereBetween('created_at', [$monday, $sunday])
            ->where('status', 'Đã hoàn thành')
            ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS count'))
            ->groupBy('date')
            ->get();

        foreach ($completedBookings as $booking) {
            $completedBookingCounts[$booking->date] = $booking->count;
        }

        // Truy vấn lịch đã hủy trong tuần
        $cancelledBookings = DB::table('booking')
            ->whereBetween('created_at', [$monday, $sunday])
            ->where('status', 'Đã được hủy')
            ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS count'))
            ->groupBy('date')
            ->get();

        foreach ($cancelledBookings as $booking) {
            $cancelledBookingCounts[$booking->date] = $booking->count;
        }

        // Xử lý ngày trong tuần
        $bookingOfWeek = [];
        $currentDay = $monday->copy();

        while ($currentDay <= $sunday) {
            $bookingOfWeek[$currentDay->format('l')] = [
                'bookings' => $bookingCounts[$currentDay->toDateString()] ?? 0,
                'completed_bookings' => $completedBookingCounts[$currentDay->toDateString()] ?? 0,
                'cancelled_bookings' => $cancelledBookingCounts[$currentDay->toDateString()] ?? 0
            ];
            $currentDay->addDay();
        }
        // tháng
        $currentYear = date('Y');
        $months = range(1, 12);
        $query = DB::table('booking')
            ->select(
                DB::raw('MONTH(created_at) AS month'),
                DB::raw('COUNT(*) AS bookings'),
                DB::raw('COUNT(CASE WHEN status = "Đã hoàn thành" THEN 1 END) AS completed_bookings'),
                DB::raw('COUNT(CASE WHEN status = "Đã được hủy" THEN 1 END) AS cancelled_bookings')
            )
            ->whereYear('created_at', $currentYear)
            ->whereIn(DB::raw('MONTH(created_at)'), $months)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $bookingOfMonth = [];
        foreach ($months as $month) {
            // Sử dụng hàm date để lấy tên tháng dựa trên số tháng
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $bookingOfMonth[$monthName] = [
                'bookings' => 0,
                'completed_bookings' => 0,
                'cancelled_bookings' => 0
            ];
        }

        // Cập nhật giá trị count từ kết quả truy vấn
        foreach ($query as $result) {
            $month = $result->month;
            // Sử dụng hàm date để lấy tên tháng dựa trên số tháng
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $bookingOfMonth[$monthName] = [
                'bookings' => $result->bookings,
                'completed_bookings' => $result->completed_bookings,
                'cancelled_bookings' => $result->cancelled_bookings
            ];
        }
        // năm
        $query = DB::table('booking')
            ->select(
                DB::raw('YEAR(created_at) AS year'),
                DB::raw('COUNT(*) AS bookings'),
                DB::raw('COUNT(CASE WHEN status = "Đã hoàn thành" THEN 1 END) AS completed_bookings'),
                DB::raw('COUNT(CASE WHEN status = "Đã được hủy" THEN 1 END) AS cancelled_bookings')
            )
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();

        $bookingOfYear = [];
        foreach ($query as $result) {
            $year = $result->year;
            $bookingOfYear[$year] = [
                'bookings' => $result->bookings,
                'completed_bookings' => $result->completed_bookings,
                'cancelled_bookings' => $result->cancelled_bookings
            ];
        }
        $todayRevenue = DB::table('bill')
            ->whereDate('created_at', Carbon::today())
            ->where('status_payment', 'Đã thanh toán')
            ->sum('total_amount');
        $pendingBookingsCount  = DB::table('booking')
            ->where('status', 'Chờ xác nhận')
            ->count();
        $completeBookingsCount  = DB::table('booking')
            ->where('status', 'Đã hoàn thành')
            ->count();
        $ongoingBookingsCount = DB::table('booking')
            ->where('status', 'Đang làm')
            ->count();
        $canceledBookingsCount = DB::table('booking')
            ->where('status', 'Đã được hủy')
            ->count();
        $waitBookingsCount = DB::table('booking')
            ->where('status', 'Đang chờ khách đến')
            ->count();
        // dd($todayRevenue, $weekRevenue, $monthRevenue, $yearRevenue );
        $serviceData = DB::table('services')
            ->leftJoin('booking_detail', 'services.id', '=', 'booking_detail.id_service')
            ->select('services.service_name', DB::raw('COUNT(booking_detail.id) as count'))
            ->groupBy('services.service_name')
            ->get();
        $labels = [];
        $data = [];
        foreach ($serviceData as $row) {
            $labels[] = $row->service_name;
            $data[] = $row->count;
        }
     $staff = DB::table('staff')
     ->count();
     $staffFreeTime = DB::table('staff')
     ->where('status', 'Đang đợi việc')
     ->count();
     $staffOn = DB::table('staff')
     ->where('status', 'Đang làm')
     ->count();
     $staffOff = DB::table('staff')
     ->where('status', 'Nghỉ')
     ->count();
     $services = DB::table('services')
     ->get();
     $bill5 = DB::table('bill')
     ->join('booking', 'booking.id', 'bill.id_booking')
     ->select('bill.*', 'booking.name')
     ->limit(5)
     ->get();
   
        return view('admin.pages.index', compact(
            [
                'allBookingToday',
                'bookingCompleteToday',
                'bookingCancelToday',
                'bookingOfWeek',
                'bookingOfMonth',
                'bookingOfYear',
                'pendingBookingsCount',
                'completeBookingsCount',
                'ongoingBookingsCount',
                'canceledBookingsCount',
                'waitBookingsCount',
                'todayRevenue',
                'labels',
                'data',
                'staff',
                'staffOn',
                'staffOff',
                'staffFreeTime',
                'services',
                'bill5'
            ]
        ));
    }
}
