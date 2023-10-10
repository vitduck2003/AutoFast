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
            'phone' => 'required',
            'password' => 'required',
        ]);
        $login = $request->only('phone', 'password');
        if (Auth::attempt($login)) {
            $user = User::where('phone', $request->phone)->first();
            // $token = $user->createToken('access_token')->plainTextToken;
            return response()->json(['message' => 'Đăng nhập thành công'], 200);
        }
        else {
            return response()->json(['message' => 'Thông tin tài khoản và mật khẩu không chính xấc'], 200);
        }
        throw ValidationException::withMessages([
            'phone' => ['Phone lỗi.'],
        ]);
    }
}
