<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model {

    protected $table = 'restauranttables';
    protected $casts = ['tableNo' => 'int'];
    protected $primaryKey = 'tableNo';
    protected $fillable = ['tableNo', 'tableStatus', 'tableType', 'maxSeats', 'orderID'];

    public function reservations(){
        return $this->belongsToMany(Reservation::class, ReservationRestaurantTable::class);
    }
}
