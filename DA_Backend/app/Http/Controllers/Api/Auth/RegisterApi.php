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
            // 'role_id' => '2',
            // 'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']),
        ]);
            return response()->json(['message' => 'Đăng kí thành công'], 201, $user);
    }
}
