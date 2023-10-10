<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ItemApi;
use App\Http\Controllers\API\Admin\NewsApi;
use App\Http\Controllers\API\Admin\UserApi;
use App\Http\Controllers\Api\Admin\RoleApi;
use App\Http\Controllers\Api\Auth\LoginApi;
use App\Http\Controllers\Api\Admin\StaffApi;
use App\Http\Controllers\Api\Admin\ReviewApi;
use App\Http\Controllers\Api\Auth\RegisterApi;
use App\Http\Controllers\Api\Client\NewsApi as ClientNewsApi;

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
Route::post('register', [RegisterApi::class, 'register']);
Route::post('login', [LoginApi::class, 'login']);
Route::post('logout', [LoginApi::class, 'logout']);
Route::resource('news',NewsApi::class);
Route::prefix('news')->group(function () {
    Route::get('/', [ClientNewsApi::class, 'index']);
    Route::get('/{id}', [ClientNewsApi::class, 'show']);
});

Route::resource('users',UserApi::class);

//api staff 
Route::prefix('staff')->group(function () {
    Route::get('/', [StaffApi::class, 'index']);
    Route::post('/', [StaffApi::class, 'store']);
    Route::get('/{id}', [StaffApi::class, 'show']);
    Route::put('/{id}', [StaffApi::class, 'update']);
    Route::delete('/{id}', [StaffApi::class, 'destroy']);
});
//api items
Route::prefix('item')->group(function () {
    Route::get('/', [ItemApi::class, 'index']);
    Route::post('/', [ItemApi::class, 'store']);
    Route::get('/{id}', [ItemApi::class, 'show']);
    Route::put('/{id}', [ItemApi::class, 'update']);
    Route::delete('/{id}', [ItemApi::class, 'destroy']);
});

//api role
Route::prefix('role')->group(function () {
    Route::get('/', [RoleApi::class, 'index']);
    Route::post('/', [RoleApi::class, 'store']);
    Route::get('/{id}', [RoleApi::class, 'show']);
    Route::put('/{id}', [RoleApi::class, 'update']);
    Route::delete('/{id}', [RoleApi::class, 'destroy']);
});
//api review
Route::prefix('review')->group(function () {
    Route::get('/', [ReviewApi::class, 'index']);
    Route::post('/', [ReviewApi::class, 'store']);
    Route::get('/{id}', [ReviewApi::class, 'show']);
    Route::put('/{id}', [ReviewApi::class, 'update']);
    Route::delete('/{id}', [ReviewApi::class, 'destroy']);
    // lấy review qua người dùng
    Route::get('user/{userId}', [ReviewApi::class, 'showByUser']);
    // lấy review qua dịch vụ
    Route::get('service/{serviceId}', [ReviewApi::class, 'showByService']);
});

 //api admin
Route::prefix('admin')->group(function () {

});
 //api client
Route::prefix('client')->group(function () {   
    //api tin tuc 
    Route::prefix('news')->group(function () {
        Route::get('/', [ClientNewsApi::class, 'index']);
        Route::get('/{id}', [ClientNewsApi::class, 'show']);
    });
});

