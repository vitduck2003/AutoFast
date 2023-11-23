<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\Define\DefineController;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = News::all();
        return view('admin\pages\news\index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin\pages\news\create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new News();
        $model->fill($request->except('image'));
        if($request->has('image')){
            $model->image = Storage::disk('public')->put('images',$request->file('image'));
            $file = str_replace('images/','',$model->image ); 
            $define = new DefineController();
            $define->save_file_path($file);
        }
        $model->save();
        return redirect()->route('new.index');
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
    public function edit(News $new)
    {
        return   view('admin\pages\news\edit',compact('new'));
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
        $model = News::findOrFail($id);
        $model->fill($request->except('image'));
        if($request->has('image')){
           $model->image = Storage::disk('public')->put('images',$request->file('image'));  
           $file = str_replace('images/','',$model->image ); 
           $define = new DefineController();
           $define->save_file_path($file);
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
        $new = News::find($id);
        if(!empty($new->image)){
            Storage::disk('public')->delete($new->image);
        }
        $new->delete($id);
        return back();
    }
}
