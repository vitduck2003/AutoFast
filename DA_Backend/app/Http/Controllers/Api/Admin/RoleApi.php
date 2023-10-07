<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
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
        $roles = Role::all();
        // return response()->json($staffs);
        return RoleResource::collection($roles);
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
        $roles = Role::create($request->all());
        // return new StaffResource($staff);
        return response()->json($roles, 201);
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
        $roles = Role::findOrFail($id);
        if ($roles) {
            return response()->json($roles);
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
        $roles = Role::findOrFail($id);
        if ($roles) {
            $roles->update($request->all());
            return response()->json($roles);
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
        $roles = Role::findOrFail($id);
        if ($roles) {
            $roles->delete();
            return response()->json(['message' => 'successfully']);
        } else {
            return response()->json([
                'error' => 'not found',
            ]);
        }
    }
}
