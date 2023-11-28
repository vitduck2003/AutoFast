<?php

namespace App\Http\Controllers\Admin\Define;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class DefineController extends Controller
{

    public function save_file_path($file,$check){
        
        $path = __DIR__;
       
        $path_goc = Str_replace('AutoFast\DA_Backend\app\Http\Controllers\Admin\Define', '', $path);
     
  
        $backend_path=  $path_goc.'AutoFast/DA_Backend/storage/app/public/images/'.$file;
       if($check ==1){
        $fontend_path =  $path_goc.'AutoFast/DA_Frontend/src/assets/img/img_service/'.$file;
       }
       if($check ==2){
        $fontend_path =  $path_goc.'AutoFast/DA_Frontend/src/assets/img/img_item/'.$file;
       }
       if($check ==3){
        $fontend_path =  $path_goc.'AutoFast/DA_Frontend/src/assets/img/img_new/'.$file;
       }

       
        if(file_exists($backend_path)){
            copy($backend_path, $fontend_path);
       }
      
    }


}
