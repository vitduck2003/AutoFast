<?php

namespace App\Http\Controllers\Cilent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function paymentReturn(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        if ($vnp_ResponseCode == '00') {
            $update_status = DB::table('bill')->where('id_booking', '=', $vnp_TxnRef)->update(['status_payment' => "Đã thanh toán"]);
            return view('client.payments.success', compact('data'));
        } else {  
            return view('client.payments.error');
        }
    }
}
