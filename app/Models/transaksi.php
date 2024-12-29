<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Nama tabel di database

    protected $primaryKey = 'id_transaksi'; // Primary key tabel

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'tanggal_waktu',
        'nomor_transaksi', //random
        'no_customer',     // Diurutkan dan di-reset
        'total',
        'nama_user',
        'bayar',
        'kembali'
    ];

    // Relasi dengan tabel transaksi_detail
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi', 'id_transaksi');
    }
}
