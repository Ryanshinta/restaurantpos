<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{

    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENT = 'percentage';

    public static $typeMap=[
        self::TYPE_FIXED => 'Fixed Discount',
        self::TYPE_FIXED => 'Percentage Discount',
    ];
    protected $fillable = [
        'code',
        'type',
        'value',
        'isActive',
        'expireDate',
    ];
    protected $casts =[
        'isActive' => 'boolean',
    ];

    protected $dates = [
        'expireDate',
    ];

}
