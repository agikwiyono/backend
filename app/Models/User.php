<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'full_name',
        'home_address',
        'age',
        'email',
        'password',
        'identity_file',
    ];

    protected $hidden = [
        'password',
    ];
}