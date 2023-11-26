<?php


use App\Http\Controllers\Admin\Log\LogController;

use App\Http\Controllers\Admin\Reviews\ReviewController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Client\ProfileApi;
use App\Http\Controllers\Staff\ProfileController;
use App\Http\Controllers\Admin\Jobs\JobController;
use App\Http\Controllers\Admin\News\NewController;
use App\Http\Controllers\Cilent\PaymentController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\staff\StaffController;
use App\Http\Controllers\Staff\Job\StaffJobController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\Home\DashboardController;
use App\Http\Controllers\Admin\Account\AccountController;
use App\Http\Controllers\Admin\Bookings\BookingController;
use App\Http\Controllers\Admin\Invoices\InvoiceController;
use App\Http\Controllers\Admin\Services\ServiceController;
use App\Http\Controllers\Admin\Profile\ProfileAdminController;
use App\Http\Controllers\Admin\ServiceItems\ServiceItemController;
use App\Http\Controllers\Admin\Statistic\StatisticController;

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

Route::get('/', function () {
  return view('admin/pages/auth/login');
});
Route::get('/staff/home', function () {
  return view('staff.pages.index');
})->name('staff.home');
// api này để ngoài cho đức
Route::get('/api/bookings/{id}', [BookingController::class, 'getBooking']);
Route::get('/api/bookings-wait/{id}', [BookingController::class, 'getBookingWait']);
Route::get('/api/bookings-cancel/{id}', [BookingController::class, 'getBookingCancel']);
Route::get('/api/bookings-complete/{id}', [BookingController::class, 'getBookingComplete']);

// payemnts
Route::get('/payment-return', [PaymentController::class, 'paymentReturn'])->name('payment.return');
Route::prefix('admin')->group(function () {
  ROute::get('home', [DashboardController::class, 'index'])->name('admin.home');
  Route::get('bookings', [BookingController::class, 'index']);
  Route::post('/bookings/{id}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
  Route::post('/bookings/{id}/revoke', [BookingController::class, 'revoke'])->name('booking.revoke');
  Route::post('/bookings/{id}/restore', [BookingController::class, 'restore'])->name('booking.restore');
  Route::get('bookings-wait', [BookingController::class, 'bookingWait'])->name('booking.wait');
  Route::get('bookings-cancel', [BookingController::class, 'bookingCancel'])->name('booking.cancel');
  Route::get('bookings-complete', [BookingController::class, 'bookingComplete'])->name('booking.complete');

  Route::get('jobs', [JobController::class, 'index']);
  Route::get('job-detail/{id}', [JobController::class, 'jobDetail']);
  Route::post('job-save-staff', [JobController::class, 'saveStaff'])->name('save.staff');
  Route::get('add/job/{id}', [JobController::class, 'viewAddJob'])->name('view.add.job');
  Route::post('add/job', [JobController::class, 'addJob'])->name('add.job');


  Route::post('start-job/{id}', [JobController::class, 'startJob'])->name('booking.startJob');
  Route::get('confirm-complete/{id}', [JobController::class, 'confirmComplete'])->name('job.confirm.complete');

  Route::get('invoice', function () {
    return view('admin/pages/invoices/invoice');
  });
  route::post('create-invoice', [InvoiceController::class, 'createInvoice'])->name('create.invoice');
  route::get('invoice', [InvoiceController::class, 'index'])->name('invoice');
  route::get('detail-invoice/{id}', [InvoiceController::class, 'detailInvoice'])->name('detail.invoice');
  route::get('update/status-payment/{id}', [InvoiceController::class, 'updatePayment'])->name('status.payment');


  Route::post('login', [LoginController::class, 'login'])->name('login');
  // Route::get('logout', [LoginController::class, 'logout'])->name('logout');

  Route::get('staff', [StaffController::class, 'index'])->name('staff');
  Route::get('staff/{id}', [StaffController::class, 'showDetail'])->name('showDetail');
  Route::get('staff/form/add', [StaffController::class, 'formAdd'])->name('show.form.add');
  Route::post('/staff', [StaffController::class, 'create'])->name('staff.create');
  Route::put('staff/update/{id}', [StaffController::class, 'update'])->name('staff-update');
  Route::delete('staff/delete/{id}', [StaffController::class, 'remove'])->name('staff-delete');
  Route::get('/search', [StaffController::class, 'search'])->name('search');
  Route::get('staff-action', [StaffController::class, 'staffAction'])->name('staff-action');
  Route::put('staff/retore/{id}', [StaffController::class, 'restore'])->name('staff-restore');


  Route::resource('service', ServiceController::class);
  Route::resource('serviceitem', ServiceItemController::class);
  Route::resource('new', NewController::class);


  Route::prefix('profile')->group(function () {
    Route::get('/{id}', [ProfileAdminController::class, 'showDetail'])->name('profile-admin');
    Route::put('/update/{id}', [ProfileAdminController::class, 'update'])->name('update-admin');
    Route::put('/update/avatar/{id}', [ProfileAdminController::class, 'updateAvatar'])->name('update-avatar-admin');
    Route::get('/show/password/{id}', [ProfileAdminController::class, 'showPass'])->name('show-password-admin');
    Route::put('/update/password/{id}', [ProfileAdminController::class, 'changePassword'])->name('change-password-admin');



  });

  Route::get('reviews', [ReviewController::class, 'index'])->name('review');
  Route::get('reviews/delete', [ReviewController::class, 'showDelete'])->name('review-show-delete');
  Route::delete('review/delete/{id}', [ReviewController::class, 'remove'])->name('review-delete');
  Route::put('review/restore/{id}', [ReviewController::class, 'restoteReview'])->name('review-restore');

});
Route::prefix('staff')->group(function () {
  Route::get('current-jobs', [StaffJobController::class, 'currentJob'])->name('staff.currentJob');
  Route::get('jobs-complete', [StaffJobController::class, 'jobComplete'])->name('staff.jobsComplete');
  Route::post('job-start', [StaffJobController::class, 'startJob'])->name('staff.job.start');
  Route::post('job-complete', [StaffJobController::class, 'jobDone'])->name('staff.job.complete');
  Route::get('profile/{id}', [ProfileController::class, 'showDetail'])->name('profile');
  Route::put('profile/update/{id}', [ProfileController::class, 'update'])->name('update-profile');
  Route::put('profile/update/avatar/{id}', [ProfileController::class, 'updateAvatar'])->name('update-avatar');
  Route::get('profile/show/password/{id}', [ProfileController::class, 'showPass'])->name('show-password');
  Route::put('profile/update/password/{id}', [ProfileController::class, 'changePassword'])->name('change-password');
  Route::post('/register', [StaffController::class, 'register'])->name('staff.register');
  Route::get('/show-register', [StaffController::class, 'showRegister'])->name('show.register');


});

Route::prefix('admin')->group(function () {
  Route::get('user', [AccountController::class, 'index'])->name('user.index');
  Route::get('layout', [AccountController::class, 'notifications'])->name('layout.notifications');

  Route::get('remove/{id}', [AccountController::class, 'remove'])->name('user.remove');
});
route::post('create-invoice', [InvoiceController::class, 'createInvoice'])->name('create.invoice');
route::get('invoice', [InvoiceController::class, 'index'])->name('invoice');
route::get('detail-invoice/{id}', [InvoiceController::class, 'detailInvoice'])->name('detail.invoice');
route::get('update/status-payment/{id}', [InvoiceController::class, 'updatePayment'])->name('status.payment');


Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('staff', [StaffController::class, 'index'])->name('staff');
Route::get('staff/{id}', [StaffController::class, 'showDetail'])->name('showDetail');
Route::get('staff/form/add', [StaffController::class, 'formAdd'])->name('show.form.add');
Route::post('/staff', [StaffController::class, 'create'])->name('staff.create');
Route::put('staff/update/{id}', [StaffController::class, 'update'])->name('staff-update');
Route::delete('staff/delete/{id}', [StaffController::class, 'remove'])->name('staff-delete');
Route::get('/search', [StaffController::class, 'search'])->name('search');

Route::resource('service', ServiceController::class);
Route::resource('serviceitem', ServiceItemController::class);
Route::resource('new', NewController::class);


Route::prefix('profile')->group(function () {
  Route::get('/{id}', [ProfileAdminController::class, 'showDetail'])->name('profile-admin');
  Route::put('/update/{id}', [ProfileAdminController::class, 'update'])->name('update-admin');
  Route::put('/update/avatar/{id}', [ProfileAdminController::class, 'updateAvatar'])->name('update-avatar-admin');
  Route::get('/show/password/{id}', [ProfileAdminController::class, 'showPass'])->name('show-password-admin');
  Route::put('/update/password/{id}', [ProfileAdminController::class, 'changePassword'])->name('change-password-admin');
});
Route::prefix('staff')->group(function () {
  Route::get('current-jobs', [StaffJobController::class, 'currentJob'])->name('staff.currentJob');
  Route::get('jobs-complete', [StaffJobController::class, 'jobComplete'])->name('staff.jobsComplete');
  Route::post('job-start', [StaffJobController::class, 'startJob'])->name('staff.job.start');
  Route::post('job-complete', [StaffJobController::class, 'jobDone'])->name('staff.job.complete');
  Route::get('profile/{id}', [ProfileController::class, 'showDetail'])->name('profile');
  Route::put('profile/update/{id}', [ProfileController::class, 'update'])->name('update-profile');
  Route::put('profile/update/avatar/{id}', [ProfileController::class, 'updateAvatar'])->name('update-avatar');
  Route::get('profile/show/password/{id}', [ProfileController::class, 'showPass'])->name('show-password');
  Route::put('profile/update/password/{id}', [ProfileController::class, 'changePassword'])->name('change-password');
});

Route::prefix('admin')->group(function () {
  Route::get('user', [AccountController::class, 'index'])->name('user.index');
  Route::get('remove/{id}', [AccountController::class, 'remove'])->name('user.remove');
});

Route::prefix('admin')->group(function () {
  Route::get('coupon', [CouponController::class, 'list_coupon'])->name('coupon.list_coupon');
  Route::get('unset-coupon', [CouponController::class, 'unset_coupon'])->name('coupon.unset_coupon');
  Route::get('delete/{coupon_id}', [CouponController::class, 'delete'])->name('coupon.delete');
  Route::get('coupon/form/add', [CouponController::class, 'insert_coupon'])->name('coupon.form.add');
  Route::post('coupon', [CouponController::class, 'create_coupon'])->name('coupon.create_coupon');
});

Route::get('sendbasicemail', [MailController::class, 'basic_email']);
Route::get('sendhtmlemail', [MailController::class, 'html_email']);
Route::get('sendattachmentemail', [MailController::class, 'attachment_email']);

Route::prefix('admin')->group(function () {
  Route::get('statistic', [StatisticController::class, 'index'])->name('statistic.index');
});
