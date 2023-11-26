<?php

namespace App\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class CouponApi extends Controller
{
    public function show(Request $request, $coupon_id)
    {
        try {
            $coupon = DB::table('coupon')->get();
            if (!$coupon) {
                return response()->json(['error' => 'Mã khuyến mại này không tồn tại'], 404);
            }
            return response()->json($coupon);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Không tìm thấy được mã khuyến mại', 500]);
        }
    }

    public function applyCoupon(Request $request)
    {
        $coupon_code = $request->input('coupon_code');

        $discount = Coupon::where('coupon_code', $coupon_code)
            ->where('created_at', '>', now())
            ->first();

        if (!$discount) {
            return response()->json(['message' => 'Mã giảm giá không hợp lệ'], 404);
        }

        // Áp dụng mã giảm giá tại đây và trả về kết quả

        return response()->json(['message' => 'Mã giảm giá đã được áp dụng thành công', 'discount' => $discount], 200);
    }

}

