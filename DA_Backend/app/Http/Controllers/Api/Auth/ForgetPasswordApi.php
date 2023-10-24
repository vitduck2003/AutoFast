<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordApiController extends Controller
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

        $verificationCode = Str::random(6);
        $user->verification_code = $verificationCode;
        $user->save();

        $sid = 'AC4cc4328ba6d84329ca6f72e09b18d6c4';
        $token = '11dc1f6aa2c2738de00fe37fc88f1f30';
        $twilioNumber = '+12055259845';

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