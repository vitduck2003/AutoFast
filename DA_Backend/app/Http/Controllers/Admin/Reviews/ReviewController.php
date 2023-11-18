<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;
class ReviewController extends Controller
{
    //
    public function index(){

        $reviews=Review::join('users', 'users.id','=','review.user_id')->join('services','services.id','=','review.service_id')->get([
            'users.name',
            'review.*',
            'services.service_name'
        ]);
        return view('admin/pages/reviews/index',compact('reviews'));
    }  
    public function showByUser($id){
        $reviews=Review::join('users', 'users.id','=','review.user_id')->join('services','services.id','=','review.service_id')->where('users.id','=',$id)->get([
            'users.name',
            'review.*',
            'services.service_name'
        ]);
        return response()->json(['message' =>'tìm thành công', 'reviews' =>$reviews], 200);
    }
}
