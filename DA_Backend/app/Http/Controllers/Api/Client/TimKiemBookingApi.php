<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TimKiemBookingApi extends Controller
{
    public function index()
    {
        
        try {
            $data = DB::table('booking')->get();

            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return response()->json(
                ['err' => 'khong show dc BOOKING'],
                Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
