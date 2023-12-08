<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordApi extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
        ]);

        $user = User::where('phone', $validatedData['phone'])->first();
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại',  'success' => false,], 404);
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

        $sid = 'ACe975d1af2b90735849ccbf27360021b6';
        $token = '13a21aaf9b52db2027850f1c68e09c11';
        $twilioNumber = '+16515043684';

        $client = new Client($sid, $token);

        $message = $client->messages->create(
            "+84".$validatedData['phone'],
            [
                'from' => $twilioNumber,
                'body' => 'Mã quên mật khẩu của bạn là: ' . $verificationCode
            ]
        );
        if($message){
            return response()->json(['message' => 'Gửi tin nhắn thành công',  'success' => true,], 200);
        }
        else {
            return response()->json(['message' => 'Gửi tin nhắn thất bại',  'success' => false,], 201);
        }

        return response()->json(['message' => 'Gửi mã xác minh thành công', 'success' => true,], 200);
    }

    public function verifyCode(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
            'verification_code' => 'required|string',
        ]);

        $user = User::where('phone', $validatedData['phone'])->first();
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại',  'success' => false,], 404);
        }

        if ($user->verification_code !== $validatedData['verification_code']) {
            return response()->json(['message' => 'Mã xác minh không đúng',  'success' => false,], 400);
        }

        return response()->json(['message' => 'Mã xác minh hợp lệ',  'success' => true,], 200);
    }

    public function resetPassword(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|string|max:255',
            'verification_code' => 'required|string',
            'new_password' => 'required|string|min:6',
        ]);

        $user = User::where('phone', $validatedData['phone'])->first();
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại', 'success' => false,], 404);
        }

        if ($user->verification_code !== $validatedData['verification_code']) {
            return response()->json([
                'success' => false,
                'message' => 'Mã xác minh không đúng'
            ], 400);
        }

        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return response()->json(['message' => 'Cập nhật mật khẩu thành công',  'success' => true,], 200);
    }
}