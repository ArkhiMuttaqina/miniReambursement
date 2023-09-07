<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUsers extends Model
{
    use HasFactory;

    protected $table = 'role_users';

    protected $fillable = [
        'name',
        'status',
    ];

    public $timestamps = true;
}
