<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_service', 'id_booking_detail', 'id_staff','item_name','item_price','target_time_done','price','status'
    ];
}
