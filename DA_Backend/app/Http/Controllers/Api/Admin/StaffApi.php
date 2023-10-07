<?php

namespace App\Http\Controllers\Api\Staff;

use App\Models\Staff;
use App\Http\Controllers\Controller;
use App\Http\Resources\StaffResource;
use Illuminate\Http\Request;

class StaffApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staff::all();
        // return response()->json($staffs);
        return StaffResource::collection($staffs);
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
        //
        $staff = Staff::create($request->all());
        // return new StaffResource($staff);
        return response()->json($staff, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $staff = Staff::findOrFail($id);
        if ($staff) {
            return response()->json($staff);
        } else {
            return response()->json([
                'error' => 'tài khoản không tồn tại'
            ]);
        }
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
        //
        $staff = Staff::findOrFail($id);
        if ($staff) {
            $staff->update($request->all());
            return response()->json($staff);
        } else {
            return response()->json([
                'error' => 'update not found',
            ]);
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
        //
        $staff = Staff::findOrFail($id);
        if ($staff) {
            $staff->delete();
            return response()->json(['message' => 'successfully']);
        } else {
            return response()->json([
                'error' => 'not found',
            ]);
        }
    }
}
