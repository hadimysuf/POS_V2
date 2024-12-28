<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'produk';
    protected $primaryKey = 'id_produk'; // Kolom primary key jika berbeda dari 'id'

    // Kolom yang dapat diisi (fillable)
    protected $fillable = ['nama_produk', 'harga', 'jumlah'];
}
