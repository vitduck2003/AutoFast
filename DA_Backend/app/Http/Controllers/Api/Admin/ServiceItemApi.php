<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ServiceItemApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = ServiceItem::query()->orderByDesc('id')->get();
            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return response()->json(
                ['err' => 'khong show dc service'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data =  new ServiceItem();
            $data->fill($request->all());
            $data->save();
            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return response()->json(
                ['err' => 'khong them dc service'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceItem $serviceItem)
    {
        return response()->json($serviceItem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data =  ServiceItem::findOrFail($id);
            $data->fill($request->all());
            $data->save();
            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);
            return response()->json(
                ['err' => 'khong sua dc service'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data =  Service::destroy($id);
            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return response()->json(
                ['err' => 'khong xoa dc service'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
