<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Service_level;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ServiceLevelApi extends Controller
{
    public function index()
    {
        try {
            $data = Service_level::query()->orderByDesc('id')->get();
            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return response()->json(
                ['err' => 'khong show dc service'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
