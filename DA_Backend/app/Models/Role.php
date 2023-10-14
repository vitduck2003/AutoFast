<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "role";

    protected $fillable = [
        'name',
        'display_name',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id_role');
    }
}
