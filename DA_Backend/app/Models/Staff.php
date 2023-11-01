<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='staff';
    protected $dates = ['deleted_at'];
    protected $fillable=[
        'id_user',
        'salary',
        'review',
        'status',
    ];

}
