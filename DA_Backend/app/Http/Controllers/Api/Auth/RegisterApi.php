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
        // if($request->phone !== "0346938386"){
        //     return response()->json([
        //         'message' => 'Số điện thoại này không thể gửi mã',
        //         'phone' => $request->phone
        //     ], 200);
        // }
        $checkemail = User::where('email', $validatedData['email'])->exists();
        $checkphone = User::where('phone', $validatedData['phone'])->exists();
        if ($checkemail) {
            return response()->json(['message' => 'Email đã tồn tại',  'success' => false], 200);
        }
        if ($checkphone) {
            return response()->json(['message' => 'Số điện thoại đã tồn tại', 'success' => false], 200);
        }
        $user = User::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
            'password' => Hash::make($validatedData['password']),
        ]);

        if ($user) {
            $verificationCode = '';
            for ($i = 0; $i < 6; $i++) {
                $verificationCode .= mt_rand(0, 9);
            }
            $verificationCode = implode('', array_map(function () {
                return mt_rand(0, 9);
            }, range(1, 6)));
            $user->verification_code = $verificationCode;
            $user->save();

            $this->sendVerificationCode($user, $verificationCode, $validatedData['phone']);

            return response()->json(['message' => 'Đăng ký thành công', 'success' => true], 200);
        } else {
            return response()->json(['message' => 'Đăng kí tài khoản thất bại', 'success' => false], 201);
        }
    }

    private function sendVerificationCode($user, $verificationCode, $phoneNumber)
    {
        $sid = 'ACe975d1af2b90735849ccbf27360021b6';
        $token = '13a21aaf9b52db2027850f1c68e09c11';
        $twilioNumber = '+16515043684';

        $client = new Client($sid, $token);

        $message = $client->messages->create(
            "+84" . $phoneNumber,
            [
                'from' => $twilioNumber,
                'body' => 'Mã xác thức tài khoản của bạn là: ' . $verificationCode
            ]
        );
        if ($message) {
            return response()->json(['message' => 'Gửi tin nhắn thành công', 'success' => true], 200);
        } else {
            return response()->json(['message' => 'Gửi tin nhắn thất bại', 'success' => false], 201);
        }
    }

    public function resendVerificationCode(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
        ]);

        $user = User::where('phone', $validatedData['phone'])->first();
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại', 'success' => false], 404);
        }

        $verificationCode = '';
        for ($i = 0; $i < 6; $i++) {
            $verificationCode .= mt_rand(0, 9);
        }
        $verificationCode = implode('', array_map(function () {
            return mt_rand(0, 9);
        }, range(1, 6)));
        $user->verification_code = $verificationCode;
        $user->save();

        $this->sendVerificationCode($user, $verificationCode, $validatedData['phone']);

        return response()->json(['message' => 'Gửi lại mã xác thành công', 'success' => true], 200);
    }

    public function verifyCode(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
            'code' => 'required|string|max:6',
        ]);

        $user = User::where('phone', $validatedData['phone'])->first();
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại', 'success' => false], 404);
        }

        if ($user->verification_code !== $validatedData['code']) {
            return response()->json(['message' => 'Mã xác minh không đúng', 'success' => false], 200);
        }

        $user->verification_code = null;
        $user->is_verified = true;
        $user->save();

        return response()->json(['message' => 'Xác minh mã thành công', 'success' => true], 200);
    }
}
