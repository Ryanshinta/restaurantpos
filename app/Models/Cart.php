<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'order_details';
    protected $fillable = ['order_id', 'product_id', 'price', 'amount', 'image'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
