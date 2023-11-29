<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CouponApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return response()->json($coupon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data =  Coupon::findOrFail($id);
            $data->fill($request->all());
            $data->save();
            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);
            return response()->json(
                ['err' => 'Không sửa được mã khuyến mãi'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data =  Coupon::destroy($id);
            return response()->json($data);
        } catch (\Exception $exception) {
            Log::error('Exception', [$exception]);

            return response()->json(
                ['err' => 'Không xóa được mã khuyến mãi'],
                 Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
