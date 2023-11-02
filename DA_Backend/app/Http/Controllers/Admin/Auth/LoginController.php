<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function username()
    {
        return 'phone';
    }
    public function login(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        
        // Thay đổi mã ở đây
        $user = User::where('phone', $credentials['phone'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->role_id == 1) {
                return redirect()->route('admin.home');
            } elseif ($user->role_id == 2) {
                session(['user_name' => $user->name, 'phone' => $user->phone]);
                return redirect()->to('staff/home');
            }
        }
    
        // Đăng nhập thất bại
        return redirect()->back()->withErrors(['login' => 'Thông tin đăng nhập không chính xác']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}