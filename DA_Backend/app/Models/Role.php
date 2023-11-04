<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'role';
    protected $guarded = [];
    public $fillable = ['name','display_name'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
