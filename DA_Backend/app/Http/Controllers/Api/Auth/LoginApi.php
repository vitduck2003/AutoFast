<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
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
           $user = User::where(function ($query) use ($request) {
                $query->where('phone', $request->phone)
                ->orWhere('email', $request->email);
           })->first();
            $token = $user->createToken('access_token')->plainTextToken;
            return response()->json([
                'message' => 'Đăng nhập thành công',
                'user' => $user,
            ], 200);
        }
        else {
            return response()->json(['message' => 'Thông tin tài khoản và mật khẩu không chính xấc'], 200);
        }
        throw ValidationException::withMessages([
            'phone' => ['Phone lỗi.'],
            'email' => ['Email lỗi.'],
        ]);
    }
    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'Đăng xuất thành công'], 200);
    }
}
