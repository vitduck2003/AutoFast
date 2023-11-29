<?php

namespace App\Http\Controllers\Staff\Home;

use App\Models\Job;
use App\Models\User;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardStaffController extends Controller
{
    public function staffIndex(){

        $currentDate = date('Y-m-d');
        $waitingJobs = DB::table('jobs')
        ->whereDate('created_at', $currentDate)
        ->where('status', 'LIKE', 'Đang chờ nhận việc')
        ->count();

        $doingJobs = DB::table('jobs')
        ->whereDate('created_at', $currentDate)
        ->where('status', 'LIKE', 'Đang làm')
        ->count();

        $completeJobs = DB::table('jobs')
        ->whereDate('created_at', $currentDate)
        ->where('status', 'LIKE', 'Đã hoàn thành')
        ->count();

        $repairPrice = DB::table('jobs')
        ->sum('price');

        $currentDate = Carbon::today();
        $monday = $currentDate->copy()->startOfWeek();
        $sunday = $currentDate->copy()->endOfWeek();

    
        // Truy vấn công việc đã hoàn thành trong tuần
        $completedWords = DB::table('jobs')
            ->whereBetween('updated_at', [$monday, $sunday])
            ->where('status', 'Đã hoàn thành')
            ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS count'))
            ->groupBy('date')
            ->get();

            $completedWordCounts = [];

        foreach ($completedWords as $words) {
            $completedWords[$words->date] = $words->count;
        }

        // Xử lý ngày trong tuần
        $wordOfWeek = [];
        $currentDay = $monday->copy();

        while ($currentDay <= $sunday) {
            $wordOfWeek[$currentDay->format('l')] = [
                'completed_words' => $completedWordCounts[$currentDay->toDateString()] ?? 0,
            ];
            $currentDay->addDay();
        }

        // tháng
        $currentYear = date('Y');
        $months = range(1, 12);
        $query = DB::table('jobs')
            ->select(
                DB::raw('MONTH(created_at) AS month'),
                DB::raw('COUNT(CASE WHEN status = "Đã hoàn thành" THEN 1 END) AS completed_words'),
            )
            ->whereYear('created_at', $currentYear)
            ->whereIn(DB::raw('MONTH(created_at)'), $months)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

            $wordOfMonth = [];

        foreach ($months as $month) {
            // Sử dụng hàm date để lấy tên tháng dựa trên số tháng
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $wordOfMonth[$monthName] = [
                'completed_words' => 0,
            ];
        }

        // Cập nhật giá trị count từ kết quả truy vấn
        foreach ($query as $result) {
            $month = $result->month;
            // Sử dụng hàm date để lấy tên tháng dựa trên số tháng
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $wordOfMonth[$monthName] = [
                'completed_words' => $result->completed_words,
            ];
        }

        // năm
        $query = DB::table('jobs')
            ->select(
                DB::raw('YEAR(created_at) AS year'),
                DB::raw('COUNT(CASE WHEN status = "Đã hoàn thành" THEN 1 END) AS completed_words'),
            )
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->get();

        $wordOfYear = [];
        foreach ($query as $result) {
            $year = $result->year;
            $wordOfYear[$year] = [
                'completed_words' => $result->completed_words,
            ];
        }
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

        $services = DB::table('services') ->get();

        return view('staff/pages/home/staffHome', compact('waitingJobs', 'doingJobs', 'completeJobs', 'repairPrice', 'wordOfWeek',
        'wordOfMonth',
        'wordOfYear', 'services', 'labels', 'data'));
    }
}