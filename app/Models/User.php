<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'fullname',
        'username',
        'notelp',
        'alamat',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
