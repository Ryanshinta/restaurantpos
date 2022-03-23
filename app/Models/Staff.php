<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $primaryKey = 'id';
    protected $fillable = ['icNumber', 'name', 'position', 'password', 'gender', 'mobile', 'email', 'birthday', 'address'];
}
