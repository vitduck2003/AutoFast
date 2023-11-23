<?php

namespace App\Http\Controllers\Admin\Define;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
class DefineController extends Controller
{

    public function save_file_path($file){
        
        $path_goc = 'C:/xampp/htdocs/duan/';
        $backend_path=  $path_goc.'AutoFast/DA_Backend/storage/app/public/images/'.$file;
        $fontend_path =  $path_goc.'AutoFast/DA_Frontend/src/assets/img/'.$file;
        if(file_exists($backend_path)){
            copy($backend_path, $fontend_path);
       }
      
    }


}
