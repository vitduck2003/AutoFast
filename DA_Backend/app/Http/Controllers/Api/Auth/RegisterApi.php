<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        if ($user) {
            $verificationCode = Str::random(6);
            $user->verification_code = $verificationCode;
            $user->save();

            $this->sendVerificationCode($user, $verificationCode, $validatedData['phone']);

            return response()->json(['message' => 'Đăng ký thành công'], 201);
        } else {
            return response()->json(['message' => 'Đăng kí tài khoản thất bại'], 201);
        }
    }

    private function sendVerificationCode($user, $verificationCode, $phoneNumber)
    {
        $sid = 'AC4cc4328ba6d84329ca6f72e09b18d6c4';
        $token = '11dc1f6aa2c2738de00fe37fc88f1f30';
        $twilioNumber = '+12055259845';

        $client = new Client($sid, $token);

        $client->messages->create(
            "+84".$phoneNumber,
            [
                'from' => $twilioNumber,
                'body' => 'Mã xác minh của bạn là: ' . $verificationCode
            ]
        );
    }

    public function resendVerificationCode(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
        ]);

        $user = User::where('phone', $validatedData['phone'])->first();
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 200);
        }

        $verificationCode = Str::random(6);
        $user->verification_code = $verificationCode;
        $user->save();

        $this->sendVerificationCode($user, $verificationCode, $validatedData['phone']);

        return response()->json(['message' => 'Gửi lại mã xác minh thành công'], 200);
    }

    public function verifyCode(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
            'code' => 'required|string|max:6',
        ]);

        $user = User::where('phone', $validatedData['phone'])->first();
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại'], 404);
        }

        if ($user->verification_code !== $validatedData['code']) {
            return response()->json(['message' => 'Mã xác minh không đúng'], 200);
        }
        $user->verification_code = null;
        $user->is_verified = true;
        $user->save();

        return response()->json(['message' => 'Xác minh mã thành công'], 200);
    }
}