<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationDetailController;
use App\Http\Controllers\RestaurantTableController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/reservation/addTable', 'App\Http\Controllers\ReservationController@addTable');

//Route::get('/', function(){
//$reservation = Reservation::find('R01');
//$reservation->restauranttables()->attach([2,3]);
//});

//Route::get('/reservation/addTable', function() {
//    $restauranttables = DB::table('restauranttables')
//            ->select('tableNo', 'maxSeats')
//            ->whereNotIn('tableNo', function ($unavailable){
//    $unavailable->select('restauranttables.tableNo')->from('restauranttables')
//    ->join('reservation_restaurant_tables', 'restauranttables.tableNo', '=', 'reservation_restaurant_tables.tableNo')
//    ->join('reservations', 'reservation_restaurant_tables.reserveId', '=', 'reservations.reserveId')
//    ->where('reservations.reserveDate', '=', '2022-03-25')
//    ->where('reservations.reserveSlot', '=', 'Evening Slot');
//            })
//    ->get();
//    return view('reservations.addTable')->with('restauranttables', $restauranttables);
//});

Route::resource('/staff', StaffController::class);

Route::resource('/restauranttable', RestaurantTableController::class);

Route::resource('/reservation', ReservationController::class);

Route::resource('/reservationdetail', ReservationDetailController::class);
