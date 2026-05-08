<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkunPelanggan extends Model
{
    protected $table = 'akun_pelanggan';
    protected $primaryKey = 'id_pelanggan';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'no_hp',
        'alamat_lengkap',
        'foto_profil',
        'otp_code',
        'otp_expires_at',
        'email_verified_at',
    ];

    const CREATED_AT = 'created_at';
}
