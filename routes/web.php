<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
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
Route::group(['middleware' => 'payment.plan'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return view('welcome');
    });

});

Auth::routes();


Route::get('/payment-plan', [App\Http\Controllers\PaymentController::class, 'create'])->name('payment-plan');
Route::post('/payment-plan', [App\Http\Controllers\PaymentController::class, 'store'])->name('select-payment-plan');
