<?php

namespace App\Http\Controllers\Api\Client;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class CouponApi extends Controller
{
    public function show()
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
        $booking_id = $request->input('booking_id');
        $discount = Coupon::where('coupon_code', $coupon_code)->first();
        if($discount){
            DB::table('booking')
            ->where('id', $booking_id)
            ->update(['discount' => $discount->coupon_number]);
            return response()->json(['message' => 'Mã giảm giá đã được áp dụng thành công',], 200);
        }else{
            return response()->json(['message' => 'Mã giảm giá không hợp lệ'], 404);
        }
          
    }

}

