<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function showDetail($id)
    {
        $profile = DB::table('users')
            ->join('staff', 'users.id', '=', 'staff.id_user')
            ->where([
                ['users.role_id', '=', 2],
                ['users.id', '=', $id]
            ])
            ->select(
                'staff.salary',
                'staff.review',
                'staff.status',
                'users.id',
                'users.name',
                'users.password',
                'users.avatar',
                'users.email',
                'users.phone',
                'users.description',
                'users.address'
            )
            ->first();
        return view('staff/pages/profile/profile', compact('profile'));
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
            DB::table('users')
                ->join('staff', 'users.id', '=', 'staff.id_user')
                ->where([
                    ['users.role_id', '=', 2],
                    ['users.id', '=', $id]
                ])
                ->update($validatedData);
            $user = DB::table('users')
                ->where([
                    ['users.role_id', '=', 2],
                    ['users.id', '=', $id]
                ])->first();
            if ($user) {
                session(['user_name' => $user->name]);
            }
            return redirect()->route('profile', ['id' => $id])->with('message', 'Sửa thành công');

        }
    }
    public function updateAvatar(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $path = $request->file('avatar')->store('public/avatar');
            $path=substr($path, 7);
            $user->avatar = $path;
            $user->save();
            if ($user) {
                session(['avatar' => $user->avatar]);
            }
        }
        return redirect()->route('profile', ['id' => $id])->with('message', 'Sửa ảnh thành công');
    }
    public function showPass($id)
    {
        $user = User::findOrFail($id);
        return view('staff/pages/profile/password', compact('user'));
    }
    public function changePassword(Request $request, $id)
    {
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);
        $user = User::findOrFail($id);
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->route('show-password', ['id' => $id])->with('warning', 'Mật khẩu hiện tại không chính xác');
        } else if ($validatedData['password'] != $validatedData['confirm_password']) {
            return redirect()->route('show-password', ['id' => $id])->with('warning', 'Mật khẩu mới không giống nhau');
        }
        $user->password = bcrypt($validatedData['password']);
        $user->save();
        return redirect()->route('show-password', ['id' => $id])->with('message', 'Đổi mật khẩu thành công');
    }

}
