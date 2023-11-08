<?php

namespace App\Http\Controllers\Admin\ServiceItems;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ServiceItem::all();
       
        return view('admin\pages\ServiceItems\index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin\pages\ServiceItems\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new ServiceItem();
        $model->fill($request->except('image'));
        if($request->has('image')){
            $model->image = Storage::disk('public')->put('images',$request->file('image'));
        }
       
        $model->save();
        return redirect()->route('serviceitem.index');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceItem $serviceitem)
    {
        return   view('admin\pages\ServiceItems\edit',compact('serviceitem'));
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
        $model = ServiceItem::findOrFail($id);
        $model->fill($request->except('image'));
        if($request->has('image')){
           $model->image = Storage::disk('public')->put('images',$request->file('image'));  
        }
        $model->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServiceItem::destroy($id);
        return back();
    }
}
