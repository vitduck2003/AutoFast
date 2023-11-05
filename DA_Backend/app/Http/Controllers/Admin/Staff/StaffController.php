<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    //
    public function index()
    {
        $staffs = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where('users.role_id', '=', 2)
            ->whereNull(['users.deleted_at', 'staff.deleted_at'])
            ->select(
                'staff.*',
                'users.name',
                'users.password',
                'users.avatar',
                'users.email',
                'users.phone',
                'users.description',
                'users.address'
            )
            ->get();
        return view('admin/pages/staffs/staffs', compact('staffs'));
    }
    public function showDetail($id)
    {
        $staff = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where([
                ['users.role_id', '=', 2],
                ['staff.id', '=', $id]
            ])
            ->select(
                'staff.*',
                'users.name',
                'users.password',
                'users.avatar',
                'users.email',
                'users.phone',
                'users.description',
                'users.address'
            )
            ->first();
        return view('admin/pages/staffs/staffEdit', compact('staff'));
    }
    public function formAdd(){
        $users = User::all()->where('role_id', '=',3);
        return view('admin/pages/staffs/staffAdd',compact('users'));
    }
    public function create(Request $request)
    {
        $keyword = $request->input('keyword');
        $results = User::where('name', 'LIKE', "%$keyword%")
        ->orWhere('email', 'LIKE', "%$keyword%")
        ->get();
        if ($request->isMethod('POST')) {
            $validatedData = $request->validate([
                'salary' => 'required|integer|max:50',
                'review' => 'required|string|max:255',
                'status' => 'required|string|max:255',
                'id_user' => 'required|exists:users,id',
            ]);
            User::where('id', $validatedData['id_user'])->update(['role_id' => 2]);
            $staff = Staff::create($validatedData);
            if ($staff) {
                return redirect()->route('staff')->with('message','Thêm thành công');
            }
        }
    }
    public function update(Request $request, $id)
    {

        if ($request->isMethod('PUT')) {
            $rules = [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'address' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'salary' => 'required|integer',
                'status' => 'required|string|max:255',
            ];
            $messages = [
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'description.required' => 'Vui lòng nhập mô tả.',
                'salary.required' => 'Vui lòng nhập Lương.',
                'status.required' => 'Vui lòng nhập trạng thái.',
            ];
            
            $validatedData = $request->validate($rules, $messages);
            // dd($validatedData['address'],$validatedData['description']);
            $staff = Staff::findOrFail($id);
            $user = User::findOrFail($staff->id_user);
            if ($request->hasFile('avatar')) {
                Storage::delete('/public/'.$request->file('avatar'));
                $path = $request->file('avatar')->store('public/avatar');
                $user->avatar = $path;
            }
            $staff->update( $validatedData);
            $user->update($validatedData);
            return redirect()->route('showDetail', ['id'=> $staff->id])->with('message','Sửa thành công');

    }
}
    public function remove($id)
    {
        $staff = Staff::findOrFail($id);
        $user = User::findOrFail($staff->id_user);
        $staff->delete();
        $user->delete();
        if ($staff && $user) {
            return redirect()->route('staff')->with('message','Xóa thành công');
        }
    }
    public function searchUser(){
        $user = User::search()->get();
        return $user;
    }
}