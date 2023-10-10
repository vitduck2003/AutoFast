<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class NewsApi extends Controller
{
    public function index()
    {
        
        try {
            $data = News::query()->orderByDesc('id')->get();

            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return response()->json(
                ['err' => 'khong show dc tin tức'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    
    public function show(News $new)
    {
        return response()->json($new);
    }
}
