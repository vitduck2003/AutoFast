<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_service','item_name','time_done','price','image'
    ];
}
