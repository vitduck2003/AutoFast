<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Define\DefineController;
// use App\Http\Controllers\MailController;

class ServiceController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data = Service::all();
        // $mail = new MailController();
        // $userdata =$data;
        // $mail->xac_nhan_dat_lich($userdata);
     
        return   view('admin\pages\services\index',compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin\pages\services\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Service();
    
        $model->fill($request->except('image_service'));
        if($request->has('image_service')){
            $name = $request->file('image_service')->getClientOriginalName();
           $model->image_service = Storage::disk('public')->putFileAs('images', $request->file('image_service'), $name);
           $model->image_service  = str_replace('images/','',$model->image_service ); 
           $define = new DefineController();
           $define->save_file_path($model->image_service );
        }
    
        $model->save();
        return redirect()->route('service.index');
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
    public function edit(Service $service)
    {
        return   view('admin\pages\services\edit',compact('service'));
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
      
        $model =  Service::findOrFail($id);

        $model->fill($request->except('image_service'));
        if($request->has('image_service')){
            $name = $request->file('image_service')->getClientOriginalName();
            $model->image_service = Storage::disk('public')->putFileAs('images', $request->file('image_service'), $name);
             $model->image_service  = str_replace('images/','',$model->image_service ); 
             $define = new DefineController();
             $define->save_file_path($model->image_service );
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
        $ser = Service::find($id);
    if(Storage::exists('images/'.$ser->image_service)){
     Storage::disk('public')->delete($ser->image_service);
    }
        $ser->delete($id);
        return back();
    }
}
