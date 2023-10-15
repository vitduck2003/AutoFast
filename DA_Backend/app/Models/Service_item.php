<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'service_id', 'service_level' ,'name' , 'price'
    ];
}
