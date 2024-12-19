<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Nama tabel di database
    protected $fillable = [
        'tanggal_waktu',
        'nomor_transaksi',
        'total',
        'nama_user',
        'bayar',
        'kembali',
        'no_customer',
    ];
}
