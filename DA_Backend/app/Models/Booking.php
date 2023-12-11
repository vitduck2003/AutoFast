<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'target_date',
        'target_time',
        'model_car',
        'mileage',
        'note',
        'status',
        'discount'
    ];
};
