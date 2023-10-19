<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'id_booking_detail', 'staff_id','time','name','images','price','status'
    ];
}
