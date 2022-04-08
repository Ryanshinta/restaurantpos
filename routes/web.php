<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationDetailController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Resources\ProductResource;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SalaryController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<<<<<<< HEAD
Route::put('/product/{id}', 'App\Http\Controllers\ProductController@update')->name("product.update");
Route::view('/testProduct', 'product.search');
=======
//Route::put('/product/{id}','App\Http\Controllers\ProductController@update')->name("product.update");
//Route::view('/testProduct','product.search');
>>>>>>> 3f146f6bf015a49834812de4a11463f8f8399282

//order
Route::get('orders/add', 'App\Http\Controllers\OrderController@add');

Route::get('orders/create', 'App\Http\Controllers\OrderController@create');

Route::resource('/order', OrderController::class);

Route::view('/showOrder', 'orders.show');

Route::get('show-package', 'App\Http\Controllers\OrderController@show');

Route::get('/api/product','App\Http\Controllers\ProductApiController@getAllProduct');

//cart
Route::get('cart/index', 'App\Http\Controllers\OrderController@index');

Route::get('/cart', [CartController::class, 'index']);

Route::get('cart', [CartController::class, 'cart'])->name('cart');

Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');

Route::post('update-cart', [CartController::class, 'update'])->name('update.cart');

Route::post('remove-from-cart', [CartController::class, 'destroy'])->name('remove.from.cart');

Route::resource('/payment', PaymentController::class);


//Product
<<<<<<< HEAD
Route::resource('/product', ProductController::class);
Route::put('/product/{id}', 'App\Http\Controllers\ProductController@update')->name("product.update");
Route::view('/testProduct', 'product.search');

//VoucherPage
Route::resource('/voucher', VoucherController::class);
//Route::post('/voucher/create',\App\Http\Controllers\VoucherController::class);
//Route::post('voucher/create', 'VoucherController@store');
Route::post('/voucher/{code}', 'VoucherController@update');
=======
Route::resource('/product',ProductController::class);
Route::put('/product/{id}','App\Http\Controllers\ProductController@update')->name("product.update");
Route::view('/searchProduct','product.search');

//VoucherPage
//Route::get()
//Route::post('/voucher/{code}','App\Http\Controllers\VoucherController@update')->name('voucher.update');
Route::resource('/voucher',VoucherController::class);
>>>>>>> 3f146f6bf015a49834812de4a11463f8f8399282


//Payment
Route::post('/payment/create/{id}', 'App\Http\Controllers\PaymentController@create');

Route::post('/payment/{id}', 'App\Http\Controllers\PaymentController@show');

Route::resource('/payment', PaymentController::class);

//Restauranttable
Route::get('/restaurantTableDisplay', [RestaurantTableController::class, 'sort']);

Route::get('/orderTable', [RestaurantTableController::class, 'orderTable']);

Route::POST('/orderUpdate', [RestaurantTableController::class, 'orderUpdate']);


//kitchen
Route::resource('/kitchen', KitchenController::class);

//Reservation
//Route::post('/reservations/addTable', 'App\Http\Controllers\ReservationController@addTable');
//Route::resource('/reservation', ReservationController::class);

//User
//Route::resource('/user', UserController::class);
Route::view('/test', 'users.search');
Route::get('/userDisplay', [UserController::class, 'sort']);

//Testing
Route::resource('/reservationDetail', ReservationDetailController::class);

Route::get('/token', function () {
    return csrf_token();
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::resource('salaries', SalaryController::class);

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('/restaurantTable', RestaurantTableController::class);
    //Route::resource('/product',ProductController::class);
});


Route::post('/reservations/addTable', 'App\Http\Controllers\ReservationController@addTable');
