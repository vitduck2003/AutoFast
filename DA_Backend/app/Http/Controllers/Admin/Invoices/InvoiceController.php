<?php

namespace App\Http\Controllers\Admin\Invoices;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Http\Controllers\MailController;
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
        $service = DB::table('booking_detail')
        ->join('services', 'services.id', 'booking_detail.id_service')
        ->select('services.service_name')
        ->where('booking_detail.id_booking', '=', $id)
        ->first();
        $booking_coppy = DB::table('booking')
        ->where('id', $id)
        ->first();
        $insert_boonking_coppy = DB::table('booking_coppy')
        ->insert([
            'id' => $booking_coppy->id,
            'name' => $booking_coppy->name,
            'phone' => $booking_coppy->phone,
            'email' => $booking_coppy->email,
            'user_id' => $booking_coppy->user_id ? $booking_coppy->user_id : null,
            'note' => $booking_coppy->note ? $booking_coppy->note : null,
            'model_car' => $booking_coppy->model_car,
            'mileage' => $booking_coppy->mileage,
            'status' => $booking_coppy->status,
            'service_name' => $service->service_name,
            'status_bill' => $booking_coppy->status_bill ? $booking_coppy->status_bill : null,
            'created_at' => $booking_coppy->created_at,
            'discount' => $booking_coppy->discount ? $booking_coppy->discount : null
        ]);
        $booking_detail_coppy = DB::table('booking_detail_coppy')
        ->where('id_booking', $id)
        ->first();
        DB::table('bill')->insert([
            'id_booking' => $data['id_booking'],
            'total_amount' => $data['total_amount'],
            'total_discount' => $data['total_discount'],
            'status_payment' => "Chưa thanh toán",
            'created_at' => now()->toDateTimeString()
        ]);
        DB::table('booking')->where('id', $id)->update(['status_bill' => 'Đã tạo hóa đơn']);
        return redirect()->back()->with('message','Tạo hóa đơn thành công');
    }
    public function detailInvoice($id){
        $invoice = DB::table('bill')
        ->join('booking_coppy', 'booking_coppy.id', '=', 'bill.id_booking')
        ->join('jobs', 'jobs.id_booking', '=', 'booking_coppy.id')
        ->select('bill.id', 'booking_coppy.name', 'booking_coppy.phone', 'booking_coppy.email', 'booking_coppy.model_car', 'booking_coppy.mileage', 'booking_coppy.service_name', 'bill.created_at', 'bill.total_amount','bill.total_discount' , 'booking_coppy.id as id_booking', 'bill.created_at', 'bill.status_payment', 'bill.method_payment')
        ->where('bill.id', '=', $id)
        ->first();
        $jobs = DB::table('jobs')
        ->select('item_name', 'item_price', 'note')
        ->where('id_booking', '=', $invoice->id_booking)
        ->get();
        return view('admin/pages/invoices/invoiceDetail', compact('invoice', 'jobs'));
    }
    public function updatePayment($id){
        $status = "Đã thanh toán";
      DB::table('bill')
        ->where('id', $id)
        ->update([
            'status_payment' => $status,
            'method_payment' => "Tiền mặt"
        ]);
   
           try{
                $mail = new MailController();
                $data = DB::table('bill')
                ->join('booking_coppy','booking_coppy.id','=','bill.id_booking')
                ->where('bill.id', $id)
                ->first();
          
                $userdata = [
                    'name' => $data->name,
                    'email' => $data->email,
                    'mileage' => $data->mileage ,
                    'model_car'=>$data->model_car,
                    'service_name'=>$data->service_name,
                ];
          
                $mail ->hen_dat_lich($userdata);
            }catch(\Exception $e){

                };
                
    
        return redirect()->back()->with('message','Cập nhật thành công');
    }
}
