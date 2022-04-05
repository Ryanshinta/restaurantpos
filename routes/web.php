<?php

use App\Models\Staff;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationDetailController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Resources\ProductResource;
use App\Models\Reservation;
use App\Models\RestaurantTable;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::post('/reservation/addTable', 'App\Http\Controllers\ReservationController@addTable');

Route::resource('/staff', StaffController::class);

//Route::view('staffDisplay', '/staffs/display');

Route::view('/test','staffs.search');

//Route::get('/test',[StaffController::class, 'search']);

Route::get('/staffDisplay', [StaffController::class, 'sort']);

Route::resource('/restaurantTable', RestaurantTableController::class);

Route::resource('/reservation', ReservationController::class);

Route::resource('/reservationDetail', ReservationDetailController::class);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/product',ProductController::class);

Route::put('/product/{id}','App\Http\Controllers\ProductController@update')->name("product.update");
Route::view('/testProduct','product.search');

Route::get('orders/add', 'App\Http\Controllers\OrderController@add');

Route::resource('/order', OrderController::class);

Route::get('/cart', [CartController::class, 'index']);

Route::get('cart', [CartController::class, 'cart'])->name('cart');

Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');

Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');

Route::delete('remove-from-cart', [CartController::class, 'destroy'])->name('remove.from.cart');



//Voucher
Route::get('voucher','App\Http\Controllers\VoucherController@getAllVoucher');
Route::get('voucher/{code}','App\Http\Controllers\VoucherController@getVoucherByCode');
