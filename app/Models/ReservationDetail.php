<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    protected $table = 'reservationdetails';
    protected $primaryKey = 'id';
    protected $fillable = ['reserveId', 'tableNo', 'state'];
    
    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }
    
    public function restauranttable(){
        return $this->belongsTo(RestaurantTable::class);
    }
}
