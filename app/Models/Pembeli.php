<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pembeli',
        'kontak',
    ];

    protected $table = 'pembeli';

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pembeli');
    }
}