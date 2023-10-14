<?php

use App\Http\Controllers\API\Admin\NewsApi;
use App\Http\Controllers\Api\Admin\ServiceApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\UserApi;
use App\Http\Controllers\Api\Auth\LoginApi;
use App\Http\Controllers\Api\Auth\RegisterApi;
use App\Http\Controllers\Api\Client\NewsApi as ClientNewsApi;
use App\Http\Controllers\Api\Admin\ServiceItemApi;
use App\Http\Controllers\Api\Admin\ServiceLevelApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//api dang nhap dang ky
Route::post('register', [RegisterApi::class, 'register']);
Route::post('login', [LoginApi::class, 'login']);
Route::post('logout', [LoginApi::class, 'logout']);
 
//api admin
Route::prefix('admin')->group(function () {
    //api quan ly user
    Route::resource('users',UserApi::class);
    //api quan ly tin tuc  http://127.0.0.1:8000/api/admin/news
    Route::resource('news',NewsApi::class);
    //api quan ly service  http://127.0.0.1:8000/api/admin/services
    Route::resource('services',ServiceApi::class);
    //api quan ly service item   http://127.0.0.1:8000/api/admin/service_item
    Route::resource('service_item',ServiceItemApi::class);
    //api quan ly service level  http://127.0.0.1:8000/api/admin/service_level
    Route::resource('service_level',ServiceLevelApi::class);
});



 //api client
Route::prefix('client')->group(function () {   
    //api tin tuc 
    Route::prefix('news')->group(function () {
        Route::get('/', [ClientNewsApi::class, 'index']);
        Route::get('/{id}', [ClientNewsApi::class, 'show']);
    });
    //api review
    Route::prefix('review')->group(function () {
        // lấy review qua người dùng
        Route::get('user/{userId}', [ReviewApi::class, 'showByUser']);
        // lấy review qua dịch vụ
        Route::get('service/{serviceId}', [ReviewApi::class, 'showByService']);
    });
});
