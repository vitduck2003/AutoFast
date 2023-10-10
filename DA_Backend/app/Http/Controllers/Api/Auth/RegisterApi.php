<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterApi extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required|integer|min:0',
            'password' => 'required|string|min:6',
        ]);
        $checkemail = User::where('email', $validatedData['email'])->exists();
        $checkphone = User::where('phone', $validatedData['phone'])->exists();
        if($checkemail){
            return response()->json(['message' => 'Email đã tồn tại'], 200);
        }
        if($checkphone){
            return response()->json(['message' => 'Số điện thoại đã tồn tại'], 200);
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
            'password' => Hash::make($validatedData['password']),
        ]);
            return response()->json(['message' => 'Đăng kí thành công'], 201);
    }
}
