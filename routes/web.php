<?php

use App\Http\Controllers\PaypalController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::post('/paypal-payment' , [PaypalController::class,'payment']);
Route::get('/paypal/success',[PaypalController::class,'success'])->name('paypal.success');
Route::get('/paypal/cancel',[PaypalController::class,'cancel'])->name('paypal.cancel');

Route::post('/stripe-payment' , [StripeController::class,'payment']);
Route::get('/stripe/success',[StripeController::class,'success'])->name('stripe.success');
Route::get('/stripe/cancel',[StripeController::class,'cancel'])->name('stripe.cancel');