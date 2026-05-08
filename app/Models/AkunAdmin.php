<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkunAdmin extends Model
{
    protected $table = 'akun_admin';
    protected $primaryKey = 'id_admin';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'no_hp',
        'nama_lengkap',
    ];
}
