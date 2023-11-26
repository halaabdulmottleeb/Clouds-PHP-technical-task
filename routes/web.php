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

Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard/users/search', [App\Http\Controllers\UserController::class, 'search'])->name('users.search');

    // Index route
    Route::get('/dashboard/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    // Create route
    Route::get('/dashboard/users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    Route::post('/dashboard/users', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');


    // Edit route
    Route::get('/dashboard/users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::put('/dashboard/users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');

    // Destroy route
    Route::delete('/dashboard/users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

    // Search route
});