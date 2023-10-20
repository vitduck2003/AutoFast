<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required_without:email',
            'email' => 'required_without:phone',
            'password' => 'required',
        ]);

        $login = $request->only('phone', 'email', 'password');
        if (Auth::attempt($login)) {
            $check_verify = User::select('is_verified')
            ->where('phone', '=', $request->phone)
            ->first();
        if (!$check_verify || !$check_verify->is_verified) {
            return response()->json([
                'message' => 'Vui lòng xác thực tài khoản',
                'phone_verified' => $request->phone
            ], 200);
        }
            $user = User::where(function ($query) use ($request) {
                $query->where('phone', $request->phone)
                    ->orWhere('email', $request->email);
            })->first();

            $token = $user->createToken('access_token')->plainTextToken;
            $role = DB::table('role')
                ->select('name')
                ->where('id', $user->role_id)
                ->first();

            return response()->json([
                'message' => 'Đăng nhập thành công',
                'user' => $user,
                'access_token' => $token,
                'role' => $role
            ], 200);
        } else {
            return response()->json(['message' => 'Thông tin tài khoản hoặc mật khẩu không chính xác'], 400);
        }
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Đăng xuất thành công'], 200);
    }
}