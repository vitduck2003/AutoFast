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

