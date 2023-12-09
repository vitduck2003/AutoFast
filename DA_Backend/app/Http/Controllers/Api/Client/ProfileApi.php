<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileApi extends Controller
{
    public function show(Request $request, $id)
    {
        //
        try {
            $profile = Profile::where('id', $id)->where('role_id', 3)->first();
            if (!$profile) {
                return response()->json(['error' => 'Người dùng không tồn tại'], 404);
            }
            return response()->json($profile);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'không tìm được user người dùng', 500]);
        }
    }
    public function uploadAvatar(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        if ($request->file('avatar')) {
            Storage::delete('/public/' . $request->avatar);
            
            $path = $request->file('avatar')->store('public/avatar');
            // $path=$request->image->move(public_path('avatar'), $request->file('avatar'));  
            $path=substr($path, 7);
            $profile->avatar = $path;
            $profile->update($request->all());
            return response()->json(['message' => 'Avatar sửa thành công','avatr'=> $path]);
        }
        return response()->json(['error' => 'Không có avatar được trong file'], 400);
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
            $user = Profile::findOrFail($id);
            if (!$user) {
                return response()->json(['error'=> 'Không tồn tại người dùng'],404);
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = Hash::make($request->input('password'));
            $user->address = $request->input('address');
            $user->description = $request->input('description');
            $user->save();
            return response()->json(['message' => 'Cập nhật người dùng thành công'], 200);
    }
    public function changePassword(Request $request, $id){
        $user = Profile::findOrFail($id);
        if (!$user) {
            return response()->json(['error'=> 'Không tồn tại người dùng'],404);
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return response()->json(['message' => 'Cập nhật mật khẩu thành công'], 200);
    }
}
