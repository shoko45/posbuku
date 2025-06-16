<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'id_pembeli',
        'id_buku',
        'total_harga',
    ];

    protected $table = 'transaksi';

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'id_pembeli');
        return $this->belongsTo(\App\Models\Pembeli::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}