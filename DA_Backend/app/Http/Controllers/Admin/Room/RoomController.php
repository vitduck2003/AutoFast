<?php

namespace App\Http\Controllers\Admin\Room;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    //
    public function index(){
        $rooms = DB::table('room')->get();
        return view('admin/pages/room/index',compact('rooms'));
    }
    public function showAdd(){
        return view('admin/pages/room/addRoom');
    }
    public function create(Request $request){
        if ($request->isMethod('POST')) {
            $rules = [
                'name' => 'required|string|max:255',
                'status' => 'required|string|max:255',
            ];
            $messages = [
                'name.required' => 'Vui lòng nhập tên.',
                'status.required' => 'Vui lòng nhập trạng thái.',
            ];

            $validatedData = $request->validate($rules, $messages);

            $room=DB::table('room')->insert([
                'name' =>$validatedData['name'],
                'status' =>$validatedData['status']
            ]);
            return redirect()->route('room-view')->with('message', 'Thêm thành công');

        }
    }
}
