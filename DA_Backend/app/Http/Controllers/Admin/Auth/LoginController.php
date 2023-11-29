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

        
            if($request->isMethod('POST')){
                if(Auth::attempt(['phone'=>$request->phone,'password'=>$request->password])){
                    if ($user && Hash::check($credentials['password'], $user->password)) {
                        if ($user->role_id == 1) {
                            session(['user_name' => $user->name,'id' => $user->id, 'phone' => $user->phone,'avatar' => $user->avatar,]);
                            return redirect()->route('admin.home');
                        } elseif ($user->role_id == 2) {
                            session(['user_name' => $user->name,'id' => $user->id, 'phone' => $user->phone,'avatar' => $user->avatar]);
                            return redirect()->to('staff/staffIndex');
                        }
                        
                }else{
                    return redirect()->back()->withErrors(['login' => 'Thông tin đăng nhập không chính xác']);
                }
            }
            return view('auth.login');
        }
        
    }

    public function logout()
    {
        Auth::logout();
        return view('admin/pages/auth/login');
    }
    public function attemptLogin(Request $request)
{
    $remember = $request->filled('remember');
    
    return $this->guard()->attempt(
        $this->credentials($request), $remember
    );
}
}
