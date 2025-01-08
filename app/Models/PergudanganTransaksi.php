<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PergudanganTransaksi extends Model
{
    use HasFactory;

    protected $table = 'pergudangan'; // Sesuaikan nama tabel
    protected $primaryKey = 'id_transaksi_gudang'; // Primary key tabel

    protected $fillable = ['id_produk', 'jumlah', 'tanggal', 'jenis_transaksi'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
