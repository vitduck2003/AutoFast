<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\ItemApi;
use App\Http\Controllers\API\Admin\NewsApi;
use App\Http\Controllers\API\Admin\UserApi;
use App\Http\Controllers\Api\Admin\RoleApi;
use App\Http\Controllers\Api\Auth\LoginApi;
use App\Http\Controllers\Api\Admin\StaffApi;
use App\Http\Controllers\Api\Auth\RegisterApi;

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

