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
    public function staffIndex()
    {
        $user = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where('users.id', '=', session('id'))
            ->whereNull(['users.deleted_at', 'staff.deleted_at'])
            ->select(
                'staff.id',
            )
            ->first();
        $staff_id = $user->id;

        $currentDate = date('Y-m-d');
        $waitingJobs = DB::table('jobs')
            ->where('status', 'LIKE', 'Đang chờ nhận việc')
            ->count();

        $doingJobs = DB::table('jobs')
            ->where('status', 'LIKE', 'Đang làm')
            ->count();

        $completeJobs = DB::table('jobs')
            ->where('status', 'LIKE', 'Đã hoàn thành')
            ->count();

        $repairPrice = DB::table('jobs')
            ->sum('price');

            $currentDate = Carbon::today();
            $monday = $currentDate->copy()->startOfWeek();
            $sunday = $currentDate->copy()->endOfWeek();
            
            // Truy vấn công việc đã hoàn thành trong tuần
            $completedWords = DB::table('jobs')
                ->where('jobs.id_staff', '=', $staff_id)
                ->whereBetween('created_at', [$monday, $sunday])
                ->where('status', '=', 'Đã hoàn thành')
                ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS count'))
                ->groupBy('date')
                ->get();
            
            $completedWordCounts = [];
            
            foreach ($completedWords as $words) {
                $completedWordCounts[$words->date] = $words->count;
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
            
            // Xử lý tháng
            $currentYear = date('Y');
            $months = range(1, 12);
            $query = DB::table('jobs')
                ->where('jobs.id_staff', '=', $staff_id)
                ->select(
                    DB::raw('MONTH(created_at) AS month'),
                    DB::raw('COUNT(CASE WHEN status = "Đã hoàn thành" THEN 1 END) AS completed_jobs')
                )
                ->whereYear('created_at', $currentYear)
                ->whereIn(DB::raw('MONTH(created_at)'), $months)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->get();
            
            $wordOfMonth = [];
            
            foreach ($months as $month) {
                $monthName = date('F', mktime(0, 0, 0, $month, 1));
                $wordOfMonth[$monthName] = [
                    'completed_words' => 0,
                ];
            }
            
            foreach ($query as $result) {
                $month = $result->month;
                $monthName = date('F', mktime(0, 0, 0, $month, 1));
                $wordOfMonth[$monthName] = [
                    'completed_words' => $result->completed_jobs,
                ];
            }
            
            // Xử lý năm
            $query = DB::table('jobs')
                ->where('jobs.id_staff', '=', $staff_id)
                ->select(
                    DB::raw('YEAR(created_at) AS year'),
                    DB::raw('COUNT(CASE WHEN status = "Đã hoàn thành" THEN 1 END) AS completed_words')
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
            
        $services = DB::table('services')->get();


        $bookings = DB::table('booking')
            ->join('room', 'room.id', '=', 'booking.id_room')
            ->where('booking.id_staff', '=', $staff_id)
            ->select('booking.*', 'room.name as room_name')
            ->limit(5)
            ->get();
        $serviceData = DB::table('services')
            ->leftJoin('booking_detail', 'services.id', '=', 'booking_detail.id_service')
            ->select('services.service_name', DB::raw('COUNT(booking_detail.id) as count'))
            ->groupBy('services.service_name')
            ->get();
        $jobs = DB::table('jobs')
            ->join('booking', 'booking.id', '=', 'jobs.id_booking')
            ->where('jobs.id_staff', '=', $staff_id)
            ->select('jobs.status', DB::raw('COUNT(jobs.id) as count'))
            ->groupBy('jobs.status')
            ->get();
        $labels = [];
        $data = [];
        foreach ($serviceData as $row) {
            $labels[] = $row->service_name;
            $data[] = $row->count;
        }
        return view('staff/pages/home/staffHome', compact('waitingJobs', 'doingJobs', 'completeJobs', 'repairPrice', 'wordOfWeek',
            'wordOfMonth',
            'wordOfYear', 'services', 'labels', 'data', 'bookings'));
    }
}