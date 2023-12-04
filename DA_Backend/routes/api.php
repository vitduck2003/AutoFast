<?php


use App\Http\Controllers\Admin\Bookings\BookingController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\NewsApi;
use App\Http\Controllers\Api\Admin\UserApi;
use App\Http\Controllers\Api\Auth\LoginApi;
use App\Http\Controllers\API\Admin\ReviewApi;
use App\Http\Controllers\Api\Admin\ServiceApi;
use App\Http\Controllers\Api\Auth\RegisterApi;
use App\Http\Controllers\Api\Client\BookingApi;
use App\Http\Controllers\Api\Client\PaymentApi;
use App\Http\Controllers\Api\Client\ProfileApi;
use App\Http\Controllers\Api\Client\ServiceItem;
use App\Http\Controllers\Api\Admin\ServiceItemApi;
use App\Http\Controllers\Api\Admin\StatisticalApi;
use App\Http\Controllers\Api\Auth\ForgetPasswordApi;
use App\Http\Controllers\Admin\staff\StaffController;
use App\Http\Controllers\Api\Admin\ManagerBookingApi;
use App\Http\Controllers\Api\Client\TimKiemBookingApi;
use App\Http\Controllers\Admin\Reviews\ReviewController;
use App\Http\Controllers\Api\Client\NewsApi as ClientNewsApi;
use App\Http\Controllers\Api\Client\ServiceApi as ClientServiceApi;
use App\Http\Controllers\Api\Client\CouponApi;

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
Route::post('register/verify-code', [RegisterApi::class, 'verifyCode']);
// api booking bên client
Route::post('booking', [BookingApi::class, 'booking']);
Route::post('send-verification-code', [ForgetPasswordApi::class, 'sendVerificationCode']);
Route::post('verify-code', [ForgetPasswordApi::class, 'verifyCode']);
Route::post('reset-password', [ForgetPasswordApi::class, 'resetPassword']);

// Admin APIs
Route::prefix('admin')->group(function () {
    Route::post('/bookings', [ManagerBookingApi::class, 'createBooking']);
    Route::get('/bookings', [ManagerBookingApi::class, 'getAllBookings']);
    Route::get('/bookings-details', [ManagerBookingApi::class, 'getBookingDetails']);
    Route::get('/booking-details/jobs', [ManagerBookingApi::class, 'getJobs']);
    Route::patch('/confirm-booking/{id}', [ManagerBookingApi::class, 'confirmBooking']);
    Route::patch('/cancel-booking/{id}', [ManagerBookingApi::class, 'cancelBooking']);
    Route::get('room', [BookingApi::class, 'getRoom']);
    // Review APIs
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewApi::class, 'index']);
        Route::post('/', [ReviewApi::class, 'store']);
        Route::get('/{id}', [ReviewApi::class, 'show']);
        Route::put('/{id}', [ReviewApi::class, 'update']);
        Route::delete('/{id}', [ReviewApi::class, 'destroy']);
    });
    // api notification
    Route::get('/notifications',[NotificationController::class, 'home']);

    //api quan ly tin tuc  http://127.0.0.1:8000/api/admin/user
    Route::resource('users', UserApi::class);

    //api quan ly service  http://127.0.0.1:8000/api/admin/services
    Route::resource('services', ServiceApi::class);
    //api quan ly serviceitem  http://127.0.0.1:8000/api/admin/service-item
    Route::resource('service-item', ServiceItemApi::class);
    // User API
    Route::resource('users', UserApi::class);

    // News API
    // Route::resource('news', NewsApi::class);
});

// Client APIs
Route::prefix('client')->group(function () {
    // booking manager 
    Route::post('bookings', [BookingApi::class, 'getBookingUser']);
    Route::post('bookings-payment', [BookingApi::class, 'getBookingPaymentPhone']);
    Route::post('cancel-booking', [BookingApi::class, 'cancelBooking']);
    // News API
    Route::prefix('news')->group(function () {
        Route::get('/', [ClientNewsApi::class, 'index']);
        Route::get('/{id}', [ClientNewsApi::class, 'show']);
    });
   // Tim kiem API
   Route::prefix('timkiem_booking')->group(function () {
    Route::get('/', [TimKiemBookingApi::class,'index']);
    });

    // Review APIs
    Route::prefix('review')->group(function () {
        // Get reviews by user
        Route::get('user/{userId}', [ReviewController::class, 'showByUser']);

        // Get reviews by service
        Route::get('service/{serviceId}', [ReviewController::class, 'showByService']);

        //update review
        Route::put('update/{id}', [ReviewController::class, 'update']);

        //store review
        Route::post('/', [ReviewController::class, 'store']);

        //list reviews
        Route::get('/', [ReviewController::class, 'list']);


        //Delete reviews
        Route::delete('delete/{id}', [ReviewController::class, 'destroy']);
    });

    //Service Api
    Route::prefix('service')->group(function () {
        // lay du lieu service http://127.0.0.1:8000/api/client/service
        Route::get('/', [ClientServiceApi::class, 'index']);
    });

    //Service item Api
    Route::prefix('service-item')->group(function () {
        // lay du item service  http://127.0.0.1:8000/api/client/service-item
        Route::get('/', [ServiceItem::class, 'index']);
    });
    Route::get('service-item-other', [ServiceItemApi::class, 'serviceItemOther']);


    Route::prefix('profile')->group(function () {
        Route::get('/{id}', [ProfileApi::class, 'show']);
        Route::put('update/{id}', [ProfileApi::class, 'update']);
        Route::post('update/avatar/{id}', [ProfileApi::class, 'uploadAvatar']);
    });
    //staff api
    Route::prefix('staff')->group(function () {
        // lay du lieu service http://127.0.0.1:8000/api/client/service
        Route::get('/', [StaffController::class, 'showClient']);
    });
});
Route::get('/demo', function () {
    return response()->json('da vao dc');
})->middleware('checkauth');

// payment
Route::post('/payment', [PaymentApi::class, 'payment']);

Route::get('users/{id}', [UserApi::class, 'show']);

// search
Route::get('/search', [StaffController::class, 'searchUser'])->name('searchUser');


// search
Route::get('/search', [StaffController::class, 'searchUser'])->name('searchUser');
Route::get('/preview/{id}', [StaffController::class, 'preview'])->name('preview');

Route::get('revenue/{option}', [StatisticalApi::class, 'getRevenue']);

// api coupon
Route::prefix('client')->group(function () {
    Route::get('coupons', [CouponApi::class, 'show']);
    Route::post('applyCoupons', [CouponApi::class, 'applyCoupon']);
});
Route::get('/bookingDetail',[BookingController::class, 'getBookingDetail']);