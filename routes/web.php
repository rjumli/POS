<?php

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

Route::get('/', function () {return inertia('Auth/Login'); });
Route::middleware(['auth'])->group(function () {
    Route::resource('/home', App\Http\Controllers\HomeController::class);
    Route::resource('/customers', App\Http\Controllers\CustomerController::class);
    Route::resource('/suppliers', App\Http\Controllers\SupplierController::class);
    Route::resource('/products', App\Http\Controllers\ProductController::class);
    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::resource('/orders', App\Http\Controllers\OrderController::class);
    Route::resource('/receives', App\Http\Controllers\ReceivedController::class);
    Route::resource('/sales', App\Http\Controllers\SaleController::class);
    Route::resource('/discounts', App\Http\Controllers\DiscountController::class);
    Route::resource('/packages', App\Http\Controllers\PackageController::class);
    Route::resource('/settings', App\Http\Controllers\SettingController::class);
});

require __DIR__.'/auth.php';