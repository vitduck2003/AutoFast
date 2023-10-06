<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='staff';
    protected $fillable=[
        'name',
        'email',
        'phone',
        'address',
        'description',
        'avatar',
        'salary',
        'review',
        'status',
    ];

}
