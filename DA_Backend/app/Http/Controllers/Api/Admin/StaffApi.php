<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Staff;
use App\Http\Controllers\Controller;
use App\Http\Resources\StaffResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $staffs = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where('users.role_id', '=',2)
            ->select('staff.*','users.name','users.password','users.avatar',
                    'users.email','users.phone','users.description','users.address' )
            ->get();
            return response()->json($staffs);
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
        return response()->json(['messages' => 123]);
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
        $staff = Staff::find($id);

        if (!$staff) {
            return response()->json(['message' => 'Nhân viên không tồn tại'], 404);
        }

        return response()->json($staff, 200);
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
        return response()->json(['messages' => 123]);
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
        return response()->json(['messages' => 123]);
    }
}
