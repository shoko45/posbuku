<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku',
        'penulis',
        'image',
        'release_date',
        'id_genre',
        'harga',
        'stok',
    ];

    protected $table = 'buku';

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'id_genre');
    }

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi');
    }
}