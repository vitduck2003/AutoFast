<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\API\NewsApi;
use App\Http\Controllers\Api\StaffApi;
use App\Http\Controllers\Api\RoleApi;
use App\Http\Controllers\Api\ItemApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::resource('users', UserController::class);
Route::resource('news',NewsApi::class);
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
    Route::get('/', [ItemApiController::class, 'index']);
    Route::post('/', [ItemApiController::class, 'store']);
    Route::get('/{id}', [ItemApiController::class, 'show']);
    Route::put('/{id}', [ItemApiController::class, 'update']);
    Route::delete('/{id}', [ItemApiController::class, 'destroy']);
});

//api role
Route::prefix('role')->group(function () {
    Route::get('/', [RoleApi::class, 'index']);
    Route::post('/', [RoleApi::class, 'store']);
    Route::get('/{id}', [RoleApi::class, 'show']);
    Route::put('/{id}', [RoleApi::class, 'update']);
    Route::delete('/{id}', [RoleApi::class, 'destroy']);
});

