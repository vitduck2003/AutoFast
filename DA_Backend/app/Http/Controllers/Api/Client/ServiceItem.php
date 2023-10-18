<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\ServiceItem as ModelsServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class ServiceItem extends Controller
{
    public function index(){
    try {
        $data = ModelsServiceItem::query()->orderByDesc('id')->get();
        return response()->json($data);
    } catch (\Exception $exception) {
        Log::error('Exception', [$exception]);

        return response()->json(
            ['err' => 'khong show dc service item'],
             Response::HTTP_INTERNAL_SERVER_ERROR);
             
        }
    }
}
