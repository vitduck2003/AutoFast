<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class ProfileApi extends Controller
{
    public function show(Request $request,$id)
    {
        //
        try{
            $profile = Profile::where('id',$id)->where('role_id',3)->first();
            if(!$profile){
                return response()->json(['error' => 'Người dùng không tồn tại'], 404);
            }
            return response()->json($profile);
        }catch(\Exception $exception){
            return response()->json(['error'=>'không tìm được user người dùng',500]);
        }
    }
    public function uploadAvatar(Request $request,$id){
        if ($request->file('avatar')) {
            Storage::delete('/public/'.$request->file('avatar'));
            $path = $request->file('avatar')->store('public/avatar');
            $profile = Profile::findOrFail($id);
            $profile->avatar = $path;
            $profile->save();
            return response()->json(['message' => 'Avatar sửa thành công']);
        }
        return response()->json(['error' => 'Không có avatar được trong file'], 400);
    }
}
