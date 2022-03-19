<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRestaurantTable extends Model {

    public function getAvailableTable($reserveDate, $reserveSlot) {
        $someVariable = Reservation::get("$reserveDate", "$reserveSlot");

        $results = DB::select(DB::raw("SELECT restauranttables.tableNo, restauranttables.maxSeats FROM restauranttables WHERE restauranttables.tableNo NOT IN "
                . "(SELECT restauranttables.tableNo FROM restauranttables JOIN "
                . "reservation_restaurant_tables ON restauranttables.tableNo = reservation_restaurant_tables.tableNo JOIN reservations "
                . "ON reservations.reserveId = reservation_restaurant_tables.reserveId WHERE reservations.reserveDate = ':reserveDate' "
                . "AND reservations.reserveSlot = ':reserveSlot'"), array(
                    'somevariable' => $someVariable,
        ));

        return $results;
    }

}
