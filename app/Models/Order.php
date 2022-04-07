<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['name', 'address'];

    public function items(){
        return $this->hasMany(Orders_list::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function formattedTotal(){
        return number_format($this->total(),2);
    }

    public function recievedAmount(){
        return $this->payments->maps(function ($i){
            return $i->amount;
        })->sum();
    }

    public function formattedRevcievedAmount(){
        return number_format($this->recievedAmount(),2);
    }
}
