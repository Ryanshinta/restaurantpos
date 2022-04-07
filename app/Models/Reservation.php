<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\State\ReserveStatus;
use Spatie\ModelStates\HasStates;

class Reservation extends Model
{
    use HasStates;

    protected $table = 'reservations';

    protected $casts = ['reserveId' => 'string',
        'reserveStatus' => ReserveStatus::class,];

    protected $primaryKey = 'reserveId';

    protected $fillable = ['reserveId', 'reserveDate',
        'reserveSlot', 'reserveStatus', 'noTableReserve',
        'noOfCust', 'custName', 'custMobile'];

    public function restauranttables(){
        return $this->belongsToMany(RestaurantTable::class, ReservationRestaurantTable::class, 'reserveId', 'tableNo');
    }
}
