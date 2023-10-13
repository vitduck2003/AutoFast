<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
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
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|integer|min:0',
            'password' => 'required|string|min:6',
        ]);

        $checkPhone = User::where('phone', $validatedData['phone'])->exists();
        $checkEmail = User::where('email', $validatedData['email'])->exists();
        if ($checkPhone) {
            return response()->json(['message' => 'Số điện thoại đã tồn tại'], 200);
        }
        if ($checkEmail) {
            return response()->json(['message' => 'Email đã tồn tại'], 200);
        }
        $verificationCode = Str::random(6);
        $user = User::create([
            'name' => $validatedData['name'],
            'phone' => '+84346938386',
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
            'password' => Hash::make($validatedData['password']),
            'verification_code' => $verificationCode
        ]);
        // Gửi mã xác minh qua SMS sử dụng Firebase Cloud Messaging
      if($user){
        $this->sendVerificationCode($user, $verificationCode, $validatedData['phone']);
        return response()->json(['message' => 'Đăng ký thành công'], 201);
      }
      else{
        return response()->json(['message' => 'Đăng kí tài khoản thất bại'], 201);
      }
    }
    private function sendVerificationCode($user, $verificationCode, $phoneNumber)
{
    $sid = 'AC4cc4328ba6d84329ca6f72e09b18d6c4';
    $token = '11dc1f6aa2c2738de00fe37fc88f1f30';
    $twilioNumber = '+12055259845';

    $client = new Client($sid, $token);

    $send_otp = $client->messages->create(
        '+84346938386',
        [
            'from' => $twilioNumber,
            'body' => 'Mã xác minh của bạn là: ' . $verificationCode
        ]
    );
   if($send_otp){
        return response()->json([
            'message' => ' Vui lòng kiểm tra SMS để xác minh'
        ]);

   }
}
   
}
