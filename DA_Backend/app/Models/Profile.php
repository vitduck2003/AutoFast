<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Model;
class Profile extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $table="users";
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role_id',
        'verification_code'
    ];
}
