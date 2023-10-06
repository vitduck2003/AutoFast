<?php

<<<<<<< HEAD
use App\Http\Controllers\Api\UserController;
=======
use App\Http\Controllers\API\NewsApi;
<<<<<<< HEAD

>>>>>>> fbf165f6f857eed922ecfee4b905af636b325c92
=======
use App\Http\Controllers\Api\StaffApi;
use App\Http\Controllers\Api\ItemApiController;
>>>>>>> 44f8b6754ab9e7352ed58cc7d3b5ff41b6befb38
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

<<<<<<< HEAD
Route::resource('users', UserController::class);
// Route::post('users/add', [UserContrller::class, 'store']);
=======
Route::resource('news',NewsApi::class);
<<<<<<< HEAD
>>>>>>> fbf165f6f857eed922ecfee4b905af636b325c92
=======
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
>>>>>>> 44f8b6754ab9e7352ed58cc7d3b5ff41b6befb38
