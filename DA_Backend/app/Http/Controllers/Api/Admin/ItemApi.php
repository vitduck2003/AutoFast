<?php

namespace App\Http\Controllers\Api\Admin;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;

class ItemApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items=Item::all();
        return ItemResource::collection($items);
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
        $item=Item::create($request->all());
        return new ItemResource($item);
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
        $item=Item::find($id);
        if($item){
            return response()->json($item);
        }else{
            return response()->json(['error' => 'not found']);
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
        $item=Item::find($id);
        if($item){
            $item->update($request->all());
            return response()->json($item);
        }else{
            return response()->json(['error' => 'update not found']);
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
        $item=Item::find($id);
        if($item){
            $item->delete();
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['error' => 'update not found']);
        }
    }
}
