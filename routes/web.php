<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\LoginAuth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::view('home', 'home');
Route::view('events', 'events');
Route::view('about', 'about');
Route::view('contact', 'contact');
Route::view('register', 'register');
Route::post('register', [RegisterController::class, 'register_fetch']);
Route::view('login', 'login');

Route::get('sendbasicemail', [MailController::class, 'basic_email']);
Route::get('sendhtmlemail', [MailController::class, 'html_email']);
Route::get('sendattachmentemail', [MailController::class, 'attachment_email']);
Route::get('verify/{email}', [RegisterController::class, 'verify_email']);
Route::view('forget_password_form', 'forget_password_form');
Route::post('forget_password_form_submit', [RegisterController::class, 'forget_password_form_submit']);
Route::get('verify_forget_pwd_otp/{email}/{token}', [RegisterController::class, 'verify_forget_pwd_otp']);
Route::post('verify_otp_forget_password_action', [RegisterController::class, 'verify_otp_forget_password_action']);
Route::post('reset_pwd_action', [RegisterController::class, 'reset_pwd_action']);
Route::post('login_authentication', [LoginController::class, 'login_authentication']);
Route::view('Reactivate_deleted_account', 'Reactivate_deleted_account');
Route::post('Reactivate_account', [LoginController::class, 'Reactivate_account']);
Route::get('user_dashboard', [LoginController::class, 'user_dashboard']);
Route::get('admin_dashboard', [LoginController::class, 'admin_dashboard']);

//Admin Panel Routes
Route::get('admin_dashboard', [AdminController::class, 'admin_dashboard'])->middleware('login_auth::class');
Route::get('logout', [LoginController::class, 'logout'])->middleware('login_auth::class');
Route::get('manage_users', [AdminController::class, 'manage_users'])->middleware('login_auth::class');
Route::get('manage_events', [AdminController::class, 'manage_events'])->middleware('login_auth::class');
Route::get('user_change_profile', [AdminController::class, 'user_change_profile'])->middleware('login_auth::class');
Route::get('user_change_password', [AdminController::class, 'user_change_password'])->middleware('login_auth::class');
Route::get('user_change_profile_picture', [AdminController::class, 'user_change_rofile_picture'])->middleware('login_auth::class');

//Razor Pay payment Gateway::
// Route::get('/payment', [PaymentController::class, 'index'])->name('index');
// Route::post('/payment', [PaymentController::class, 'create'])->name('create');
// Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('callback');

Route::get('/payment_form', [PaymentController::class, 'index'])->name('home');
Route::get('/success', [PaymentController::class, 'success']);
Route::post('/payment', [PaymentController::class, 'payment']);

Route::post('/pay', [PaymentController::class, 'pay']);
Route::get('/error', [PaymentController::class, 'error']);
