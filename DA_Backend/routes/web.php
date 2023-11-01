<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Jobs\JobController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Staff\Job\StaffJobController;
use App\Http\Controllers\Admin\Bookings\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
  return view('admin/pages/auth/login');
});
Route::get('/admin/home', function () {
       return view('admin.pages.index');
    })->name('admin.home');
Route::get('/staff/home', function () {
       return view('staff.pages.index');
    })->name('staff.home');
    // api này để ngoài cho đức
    Route::get('/api/bookings/{id}', [BookingController::class, 'getBooking']);
    Route::get('/api/bookings-wait/{id}', [BookingController::class, 'getBookingWait']);
    Route::get('/api/bookings-cancel/{id}', [BookingController::class, 'getBookingCancel']);
    Route::get('/api/bookings-complete/{id}', [BookingController::class, 'getBookingComplete']);

    Route::prefix('admin')->group(function () {
        
        Route::get('bookings', [BookingController::class, 'index']);
        Route::post('/bookings/{id}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
        Route::post('/bookings/{id}/revoke', [BookingController::class, 'revoke'])->name('booking.revoke');
        Route::post('/bookings/{id}/restore', [BookingController::class, 'restore'])->name('booking.restore');
        Route::get('bookings-wait', [BookingController::class, 'bookingWait'])->name('booking.wait');
        Route::get('bookings-cancel', [BookingController::class, 'bookingCancel'])->name('booking.cancel');
        Route::get('bookings-complete', [BookingController::class, 'bookingComplete'])->name('booking.complete');
        Route::get('jobs', [JobController::class, 'index']);
        Route::get('job-detail/{id}', [JobController::class, 'jobDetail']);
        Route::post('start-job/{id}', [JobController::class, 'startJob'])->name('booking.startJob');
        Route::get('confirm-complete/{id}', [JobController::class, 'confirmComplete'])->name('job.confirm.complete');
        Route::post('login', [LoginController::class, 'login'])->name('login');
    });
    Route::prefix('staff')->group(function () {
      Route::get('current-jobs',[StaffJobController::class, 'currentJob'])->name('staff.currentJob')->name('test');
    });
    Route::get('services', function () {
      return view('admin//services/bookings');
    });
