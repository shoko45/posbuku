<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_buku',
        'jumlah_beli',
        'subtotal',
    ];

    protected $table = 'detail_transaksi';

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}