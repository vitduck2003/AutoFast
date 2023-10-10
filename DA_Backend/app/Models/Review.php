<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Review extends Model
{
    use HasFactory, SoftDeletes;
    protected $table='review';
    protected $fillable=[
        'id_user', 'content'
    ];
    public function user(){
        return $this->belongsTo(Users::class);
    }
    public function service(){
        return $this->belongsTo(Services::class);
    }
}
