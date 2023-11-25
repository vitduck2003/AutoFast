<?php

namespace App\Http\Controllers\Admin\ServiceItems;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Define\DefineController;

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
        foreach($data as $item){
            $service = Service::select('service_name')->where('id', $item->id_service)->first();
            if($service){
                $item['servicename'] = $service->service_name;
            }else{
                $item['servicename'] ="không nằm trong dịch vụ nào";
            }
        }

        return view('admin\pages\ServiceItems\index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Service::all();
        return view('admin\pages\ServiceItems\create',compact('data'));
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
            $model->image  = str_replace('images/','',$model->image ); 
            $define = new DefineController();
            $define->save_file_path( $model->image );

           
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
        $dataservice = Service::all();

         $service = Service::select('id','service_name')->where('id', $serviceitem->id_service)->first();
        
         if($service){
                $serviceitem['servicename'] = $service->service_name;
                $serviceitem['idservice'] = $service->id;
            }else{
                $serviceitem['servicename'] ="không nằm trong dịch vụ nào";
                $serviceitem['idservice'] = "";
            }
        

        return   view('admin\pages\ServiceItems\edit',compact(['serviceitem','dataservice']));
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
            $model->image  = str_replace('images/','',$model->image ); 
            $define = new DefineController();
            $define->save_file_path( $model->image );
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
        $seritem = ServiceItem::find($id);
        if(!empty($seritem->image)){
            Storage::disk('public')->delete($seritem->image);
        }
        $seritem->delete($id);
        return back();
    }
}
