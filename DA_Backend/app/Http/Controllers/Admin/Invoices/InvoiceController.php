<?php

namespace App\Http\Controllers\Admin\Invoices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Coupon;

class InvoiceController extends Controller
{
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_avaiable = 0;
                    if($is_avaiable==0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng');
        }
    }

       


    public function index(){
        $bills = DB::table('bill')
        ->join('booking', 'bill.id_booking', '=', 'booking.id')
        ->join('booking_detail', 'booking_detail.id_booking', '=', 'bill.id_booking')
        ->join('services', 'services.id', '=', 'booking_detail.id_service')
        ->select('booking.name', 'booking.model_car', 'services.service_name', 'bill.status_payment', 'bill.id', 'bill.total_amount')
        ->get();
        // dd($bills);
        return view('admin/pages/invoices/invoice', compact('bills'));
    }
    public function createInvoice(Request $request)
    {
        $data = $request->except('_token');
        $id = $data['id_booking'];
        DB::table('bill')->insert([
            'id_booking' => $data['id_booking'],
            'total_amount' => $data['total_amount'],
            'status_payment' => "Chưa thanh toán",
            'created_at' => now()->toDateTimeString()
        ]);
        DB::table('booking')->where('id', $id)->update(['status_bill' => 'Đã tạo hóa đơn']);
        return redirect()->back()->with('message','Tạo hóa đơn thành công');
    }
    public function detailInvoice($id){
        $invoice = DB::table('bill')
        ->join('booking', 'booking.id', '=', 'bill.id_booking')
        ->join('jobs', 'jobs.id_booking', '=', 'booking.id')
        ->select('bill.id', 'booking.name', 'booking.phone', 'booking.email', 'booking.model_car', 'booking.mileage', 'bill.created_at', 'bill.total_amount', 'booking.id as id_booking', 'bill.created_at', 'bill.status_payment', 'bill.method_payment')
        ->where('bill.id', '=', $id)
        ->first();
        $service = DB::table('booking_detail')
        ->join('services', 'services.id', 'booking_detail.id_service')
        ->select('services.service_name')
        ->where('booking_detail.id_booking', '=', $invoice->id_booking)
        ->first();
        $jobs = DB::table('jobs')
        ->select('item_name', 'item_price', 'note')
        ->where('id_booking', '=', $invoice->id_booking)
        ->get();
        return view('admin/pages/invoices/invoiceDetail', compact('invoice', 'jobs', 'service'));
    }
    public function updatePayment($id){
        $status = "Đã thanh toán";
        DB::table('bill')
        ->where('id', $id)
        ->update([
            'status_payment' => $status,
            'method_payment' => "Tiền mặt"
        ]);   
        return redirect()->back()->with('message','Cập nhật thành công');
    }
}
