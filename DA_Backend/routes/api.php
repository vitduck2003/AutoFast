<?php

<<<<<<< HEAD
use App\Http\Controllers\Api\UserController;
=======
use App\Http\Controllers\API\NewsApi;

>>>>>>> fbf165f6f857eed922ecfee4b905af636b325c92
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
>>>>>>> fbf165f6f857eed922ecfee4b905af636b325c92
