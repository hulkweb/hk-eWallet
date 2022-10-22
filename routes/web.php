<?php

use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('index');
});


Route::get("/login",[UserController::class,"login"])->name('login');

Route::get("/logout",[UserController::class,"logout"])->name('logout');
Route::get("/register",[UserController::class,"register"])->name('register');
Route::post("/login",[UserController::class,"authenticate"])->name('authenticate');
Route::post("/register",[UserController::class,"store"])->name('user.store');
Route::post("/check-number",[UserController::class,"check"])->name('user.check');

Route::get("/razorpay",[RazorpayController::class,"index"])->name('razorpay.index');
Route::post("/razorpay",[RazorpayController::class,"store"])->name('razorpay.store');



Route::middleware("auth")->group(function(){
   Route::get("/dashboard",[UserController::class,"dashboard"])->name('dashboard');
   Route::get("/send_money",[TransactionController::class,"send_money"])->name('send_money');
   Route::get("/add_money",[TransactionController::class,"add_money"])->name('add_money');
   Route::resource("transactions",TransactionController::class);

});
