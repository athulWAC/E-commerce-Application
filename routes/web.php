<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotpasswordController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\SmsMsgController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('/')->middleware('LogoutMiddleware')->group(function () {
    Route::get('/', [AdminController::class, 'login'])->name('login');
});
// forgot-password
// Route::post('forgot-password/request', [ForgotpasswordController::class, 'forgotPasswordRequest'])->name('forgotPasswordRequest');
// Route::get('forget-password', [ForgotpasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');


Route::get('forgot-password', [ForgotpasswordController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('forget-password', [ForgotpasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotpasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotpasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::post('loginVal', [AdminController::class, 'loginVal'])->name('loginVal')->middleware("throttle:10,2");;
Route::get('logout', [AdminController::class, 'logout'])->name('logout');



Route::prefix('/')->middleware('LoginMiddleware')->group(function () {


    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('category', [AdminController::class, 'category'])->name('category');

    // products
    Route::get('product', [AdminController::class, 'product'])->name('product');
    Route::post('product/create', [AdminController::class, 'createProduct'])->name('createProduct');
    Route::post('product/csv-insert', [AdminController::class, 'createProduct1'])->name('createProduct1');
    Route::get('product/edit/{id}', [AdminController::class, 'editProduct'])->name('editProduct');
    Route::post('product/update', [AdminController::class, 'updateProduct'])->name('updateProduct');
    Route::post('product/delete', [AdminController::class, 'deleteProduct'])->name('deleteProduct');

    // orders
    Route::get('order', [AdminController::class, 'order'])->name('order');
    Route::post('getamount', [AdminController::class, 'getAmount'])->name('getAmount');
    Route::post('changeStatus', [AdminController::class, 'changeStatus'])->name('changeStatus');
    Route::post('addOrder', [AdminController::class, 'addOrder'])->name('addOrder');
    Route::get('orderDatatable', [AdminController::class, 'orderDatatable'])->name('orderDatatable');
    Route::post('delete-order', [AdminController::class, 'deleteOrder'])->name('deleteOrder');


    Route::get('invoice/{id}', [AdminController::class, 'invoice'])->name('invoice');




    // payment with script
    Route::get('razorpay-payment', [RazorpayPaymentController::class, 'index'])->name('rayzorpay');
    Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');

    // payment with order
    Route::get('razoerpay-order', [RazorpayController::class, 'index'])->name('razorpayOrder');
    Route::get('paywithrazorpay', [RazorpayController::class, 'payWithRazorpay'])->name('paywithrazorpay');
    Route::post('payment', [RazorpayController::class, 'payment'])->name('payment');
    Route::post('confirm', [RazorpayController::class, 'confirm'])->name('confirm');
    // Route::post('login', [AdminController::class, 'login'])->name('admin.login');

    // paypal
    // Route::get('handle-payment', [AdminController::class, 'handlePayment'])->name('make.payment');
    // Route::get('cancel-payment', [AdminController::class, 'paymentCancel'])->name('cancel.payment');
    // Route::get('payment-success', [AdminController::class, 'paymentSuccess'])->name('success.payment');

    Route::get('send-sms-notification', [SmsMsgController::class, 'sendSmsToMobile'])->name('vonage');
    // Route::get('send-sms-notification1', [SmsMsgController::class, 'sendSmsToMobile1'])->name('sms1');
    Route::get('send-sms-notification1', [SmsMsgController::class, 'sendMessage'])->name('twilio');
    Route::get('/generate-qrcode', [QrCodeController::class, 'index'])->name('qr');
});

// socialite
Route::get('/auth/redirect/{provider}', [GoogleLoginController::class, 'redirect'])->name('google.redirect');
Route::get('callback/{provider}', [GoogleLoginController::class, 'callback'])->name('google.callback');



Route::get('test', function () {
    event(new App\Events\UserLogin('Someone'));
    return "Event has been sent!";
});
