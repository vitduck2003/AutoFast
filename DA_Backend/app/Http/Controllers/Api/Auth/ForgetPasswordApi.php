<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgetPasswordApi extends Controller
{
    public function ForgetPasswordApi(Request $request){
    $validatedData = $request->validate([
        'phone' => 'required|string|max:255',
    ]);

    $user = User::where('phone', $validatedData['phone'])->first();
    if (!$user) {
        return response()->json(['message' => 'Người dùng không tồn tại'], 404);
    }

    // Tạo một mã xác minh mới
    $verificationCode = Str::random(6);
    $user->verification_code = $verificationCode;
    $user->save();

    // Gửi mã xác minh mới đến số điện thoại người dùng
    $this->sendVerificationCode($user, $verificationCode, $validatedData['phone']);

    return response()->json(['message' => 'Gửi mã xác minh thành công'], 200);
}
    private function sendVerificationCode($user, $verificationCode, $phoneNumber)
    {
        $sid = 'AC4cc4328ba6d84329ca6f72e09b18d6c4';
        $token = '11dc1f6aa2c2738de00fe37fc88f1f30';
        $twilioNumber = '+12055259845';
    
        $client = new Client($sid, $token);
    
        $message = $client->messages->create(
            "+84".$phoneNumber,
            [
                'from' => $twilioNumber,
                'body' => 'Mã quên mật khẩu của bạn là: ' . $verificationCode
            ]
        );
        if($message){
            return response()->json(['message' => 'Gửi tin nhắn thành công'], 200);
        }
        else {
            return response()->json(['message' => 'Gửi tin nhắn thất bại'], 201);
        }
    }
}