<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserApi extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $users->transform(function ($user) {
        $user->password = Hash::make($user->password);
        return $user;
    });

    return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            // 'address' => 'required|string|max:255',
            'role_id' => 'required|integer|min:0',
            'password' => 'required|string|min:6',
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
            'password' => Hash::make($validatedData['password']),
        ]);
            return response()->json(['message' => 'Đăng kí cồng thanh'], 201, $user);
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
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'role_id' => 'required|integer|min:0',
        'password' => 'required|string|min:6',
    ]);

    $user = User::findOrFail($id);

    $user->name = $validatedData['name'];
    $user->phone = $validatedData['phone'];
    $user->email = $validatedData['email'];
    $user->role_id = $validatedData['role_id'];
    $user->password = Hash::make($validatedData['password']);

    $user->save();

    return response()->json(['message' => 'Cập nhật người dùng thành công', 'user' => $user], 200);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = User::FindOrFail($id);
        if($user_id){
            $user_id->delete();
            return response()->json(['success' => "Xóa thành công tài khoản id:" .$id]);
        }
    }
}
