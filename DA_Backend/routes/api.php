<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\NewsApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StaffApi;
use App\Http\Controllers\Api\Auth\UserController;
use App\Http\Controllers\Api\ItemApiController;

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

