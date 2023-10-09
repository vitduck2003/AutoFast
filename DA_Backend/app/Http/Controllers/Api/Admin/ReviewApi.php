<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews = Review::all();
        return ReviewResource::collection($reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $userId = $request->input('user_id');
        $existingReview = Review::where('user_id', $userId)->first();
        if ($existingReview) {
            return response()->json(['message' => 'Bạn đã có đánh giá.'], 422);
        }else{
            $userId = $request->input('user_id');
            $serviceId = $request->input('service_id');
            $content = $request->input('content');
            
            $review = new Review();
            $review->user_id = $userId;
            $review->service_id = $serviceId;
            $review->content = $content;
            $review->save();
            
            return response()->json(['message' => 'Đánh giá đã được lưu.']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $review = Review::find($id);
        if ($review) {
            return response()->json($review);
        } else {
            return response()->json(['error' => 'đánh giá không tồn tại']);
        }
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
        //
        $review = Review::find($id);
        if ($review) {
            $review->update($request->all());
            return response()->json($review);
        } else {
            return response()->json(['error' => 'đánh giá không tồn tại']);
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
        //
        $review = Review::find($id);
        if ($review) {
            $review->delete();
            return response()->json(['message' => 'xóa thành công']);
        } else {
            return response()->json(['error' => 'đánh giá không tồn tại']);
        }
    }

    public function showByUser($userId)
    {
        //
        $reviews = Review::where('user_id', $userId)->get();
        return response()->json($reviews);
    }
    public function showByService($serviceId)
    {
        //
        $reviews = Review::where('service_id', $serviceId)->get();
        return response()->json($reviews);
    }
}
