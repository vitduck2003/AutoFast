<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
    public function remove($id){
        $review = Review::find($id);
        if($review){
            $review->delete();
            return redirect()->route('review')->with('message', 'Xóa thành công');
        }
    }
    public function showByUser($id){
        $reviews=Review::join('users', 'users.id','=','review.user_id')->join('services','services.id','=','review.service_id')->where('users.id','=',$id)->get([
            'users.name',
            'review.*',
            'services.service_name'
        ]);
        return response()->json(['message' =>'tìm thành công', 'reviews' =>$reviews], 200);
    }public function showByService($id){
        $reviews=Review::join('users', 'users.id','=','review.user_id')->join('services','services.id','=','review.service_id')->where('services.id','=',$id)->get([
            'users.name',
            'review.content',
            'review.rating',
            'review.id',
            'services.service_name'
        ]);
        return response()->json(['message' =>'tìm thành công', 'reviews' =>$reviews], 200);
    }
    public function destroy($id){
        
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['error' => 'Đánh giá không tồn tại'], 404);
        }
        $review->delete();
        return response()->json(['message' =>'Xóa đánh giá thành công'], 200);

    }
    public function update(Request $request,$id){
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['error' => 'Đánh giá không tồn tại'], 404);
        }
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'content' => 'required|string',
        ]);

        // Cập nhật thông tin đánh giá
        $review->rating = $validatedData['rating'];
        $review->content = $validatedData['content'];
        $review->save();
        return response()->json(['message' =>'Sửa đánh giá thành công'], 200);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'service_name' => 'required|string',

        ]);
        $review = new Review();

        $review->rating = $validatedData['rating'];
        $review->content = $validatedData['content'];
        $review->user_id = $validatedData['user_id'];
        $review->service_id = $validatedData['service_id'];
        $review->service_name = $validatedData['service_name'];
        $review->save();
        return response()->json(['message' => 'Đánh giá đã được thêm thành công'], 201);
    }
    public function list(){
        $reviews=Review::join('users', 'users.id','=','review.user_id')->join('services','services.id','=','review.service_id')->get([
            'users.name',
            'review.*',
            'services.service_name as serviceName'
        ]);
        return response()->json(['message' => 'đây là danh sách đánh giá','reviews'=> $reviews], 201);
    }
    public function showDelete(){

        $reviews = DB::table('review')
            ->join('users', 'users.id','=','review.user_id')->join('services','services.id','=','review.service_id')
            ->whereNotNull('review.deleted_at')
            ->select(
                'users.name',
                'review.*',
                'services.service_name'
            )
            ->get();
        return view('admin/pages/reviews/delete',compact('reviews'));
    }
    public function restoteReview($id){
        $review=DB::table('review')->where('id', $id)->update(['deleted_at'=>NULL]);
        if($review){
            return redirect()->route('review-show-delete')->with('message', 'Khôi phục thành công');
        }else{
            return redirect()->route('review-show-delete')->with('error', 'Khôi phục không thành công');

        }
    }
}
