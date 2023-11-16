<?php

namespace App\Http\Controllers\Admin\Profile;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileAdminController extends Controller
{
    //
    public function showDetail($id)
    {
        
        $profile = User::where('role_id','=',1)->findOrFail($id);
        return view('admin/pages/profile/profile', compact('profile'));
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
            ];
            $messages = [
                'name.required' => 'Vui lòng nhập tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Vui lòng nhập đúng định dạng email.',
                'phone.required' => 'Vui lòng nhập số điện thoại.',
                'description.required' => 'Vui lòng nhập mô tả.',
            ];

            $validatedData = $request->validate($rules, $messages);
            $user = DB::table('users')
                ->where('id', '=', $id);
            $user->update($validatedData);
            return redirect()->route('profile-admin', ['id' => $id])->with('message', 'Sửa thành công');

        }
    }
    public function updateAvatar(Request $request,$id){
        $user = User::findOrFail($id);
        if ($request->hasFile('avatar')) {
            Storage::delete($user->avatar);
            $path = $request->file('avatar')->store('public/avatar');
            $user->avatar = $path;

            $user->save();
            session('avatar')===$user->avatar;

        }
        return redirect()->route('profile-admin', ['id' => $id])->with('message', 'Sửa ảnh thành công');
    }
    public function showPass($id) {
        $user = User::findOrFail($id);
        return view('admin/pages/profile/password', compact('user'));
    }
    public function changePassword(Request $request,$id){
            $validatedData = $request->validate([
            'current_password' =>'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user = User::findOrFail($id);
        if(!Hash::check($validatedData['current_password'],$user->password)){
            return redirect()->route('show-password-admin', ['id' => $id])->with('warning', 'Mật khẩu hiện tại không chính xác');
        }else if($validatedData['password'] != $validatedData['confirm_password']){
            return redirect()->route('show-password-admin', ['id' => $id])->with('warning', 'Mật khẩu mới không giống nhau');
        }
        $user->password = bcrypt($validatedData['password']);
        $user->save();
        return redirect()->route('show-password-admin', ['id' => $id])->with('message', 'Đổi mật khẩu thành công');
    }

}