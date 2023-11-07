<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentApi extends Controller
{
    public function payment(Request $request)
    {
        $data = $request->all();
        // return response()->json($data);
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/payment-return";
        $vnp_TmnCode = "6S323993"; //Mã website tại VNPAY 
        $vnp_HashSecret = "WFRWTAEZJTEQOKUHOBGWJJBNSBOGKVOF"; //Chuỗi bí mật

        $vnp_TxnRef = $data['id']; 
        $vnp_OrderInfo = $data['service_name'];
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data['total_price'] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($data['redirect']) && $data['redirect'] == true) {
            $returnData = array(
                'code' => '00',
                'message' => 'success',
                'redirect_url' => $vnp_Url
            );
            return response()->json($returnData);
        } else {
            echo json_encode($returnData);
        }
    }
    public function paymentReturn(Request $request)
{
    $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    $vnp_TxnRef = $request->input('vnp_TxnRef');
    return response()->json('Duc dep trai vcl');
    if ($vnp_ResponseCode == '00') {
        // Thành công: xử lý logic sau khi thanh toán thành công
        // Dùng $vnp_TxnRef để xác định đơn hàng tương ứng và cập nhật trạng thái, thông tin thanh toán, vv.
        // Ví dụ: Order::where('transaction_id', $vnp_TxnRef)->update(['status' => 'paid']);

        // Chuyển hướng người dùng đến trang thành công
        return redirect()->route('payment.success');
    } else {
        // Lỗi: xử lý logic khi thanh toán thất bại
        // Ví dụ: Order::where('transaction_id', $vnp_TxnRef)->update(['status' => 'failed']);

        // Chuyển hướng người dùng đến trang lỗi
        return redirect()->route('payment.error');
    }
}
}
