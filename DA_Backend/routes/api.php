<?php

use App\Http\Controllers\API\Admin\NewsApi;
use App\Http\Controllers\Api\Admin\ServiceApi;
use App\Http\Controllers\Api\Admin\UserApi;
use App\Http\Controllers\Api\Auth\LoginApi;
use App\Http\Controllers\Api\Auth\RegisterApi;
use App\Http\Controllers\Api\Client\NewsApi as ClientNewsApi;
use App\Http\Controllers\Api\Admin\ServiceItemApi;
use App\Http\Controllers\Api\Admin\ServiceLevelApi;
use App\Http\Controllers\API\Admin\ReviewApi;
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

// Authentication and Registration APIs
Route::post('register', [RegisterApi::class, 'register']);
Route::post('login', [LoginApi::class, 'login']);
Route::post('logout', [LoginApi::class, 'logout']);
Route::post('register/resend-verification-code', [RegisterApi::class, 'resendVerificationCode']);
Route::post('register/verify-code', [RegisterApi::class,'verifyCode']);

// Admin APIs
Route::prefix('admin')->group(function () {
    // Review APIs
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewApi::class, 'index']);
        Route::post('/', [ReviewApi::class, 'store']);
        Route::get('/{id}', [ReviewApi::class, 'show']);
        Route::put('/{id}', [ReviewApi::class, 'update']);
        Route::delete('/{id}', [ReviewApi::class, 'destroy']);
    });

    // User API
    Route::resource('users', UserApi::class);

    // News API
    Route::resource('news', NewsApi::class);

    // Service API
    Route::resource('services', ServiceApi::class);

    // Service Item API
    Route::resource('service_item', ServiceItemApi::class);

    // Service Level API
    Route::resource('service_level', ServiceLevelApi::class);
});

// Client APIs
Route::prefix('client')->group(function () {
    // News API
    Route::prefix('news')->group(function () {
        Route::get('/', [ClientNewsApi::class, 'index']);
        Route::get('/{id}', [ClientNewsApi::class, 'show']);
    });

    // Review APIs
    Route::prefix('review')->group(function () {
        // Get reviews by user
        Route::get('user/{userId}', [ReviewApi::class, 'showByUser']);

        // Get reviews by service
        Route::get('service/{serviceId}', [ReviewApi::class, 'showByService']);
    });
});