<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Description of Payment
 *
 * @author Gan
 */
class Payment extends Model{
    protected $table = 'payment';
    protected $primaryKey = 'paymentID';
    protected $fillable = ['orderID','applyVoucher','totalBeforeTax','serviceTax','paymentStatus'];
}
