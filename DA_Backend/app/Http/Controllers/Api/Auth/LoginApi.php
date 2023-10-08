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
            'phone' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::where('phone', $request->phone)->first();
            $token = $user->createToken('access_token')->plainTextToken;
            return response()->json(['access_token' => $token], 200, ['message' => 'Đăng nhập thành công']);
        }

        throw ValidationException::withMessages([
            'phone' => ['Phone lỗi.'],
        ]);
    }
}
