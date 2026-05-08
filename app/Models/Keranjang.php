<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $primaryKey = 'id_keranjang';

    public $timestamps = false;

    protected $fillable = [
        'id_pelanggan',
    ];

    public function items()
    {
        return $this->hasMany(ItemKeranjang::class, 'id_keranjang', 'id_keranjang');
    }

    public function pelanggan()
    {
        return $this->belongsTo(AkunPelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
