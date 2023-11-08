<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    public function list_coupon(){
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();
    	return view('admin.pages.coupon.list_coupon')->with(compact('coupon'));
    }


    public function insert_coupon(){
    	return view('admin.pages.coupon.insert_coupon');
    }


    public function unset_coupon(){
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}


    public function delete($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
        return redirect()->route('coupon.list_coupon')->with('message','Xóa mã thành công');
    }
    

    public function create_coupon(Request $request){
    	$data = $request->all();

    	$coupon = new Coupon;

    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_time = $data['coupon_time'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->save();

    	Session::put('message','Thêm mã giảm giá thành công');
        return redirect()->route('coupon.list_coupon')->with('message','Thêm mã thành công');

    }
}
