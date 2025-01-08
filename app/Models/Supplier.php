<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Supplier extends Model
{
    protected $table = 'supplier'; // Nama tabel di database
    protected $primaryKey = 'id_supplier'; // Primary key tabel

    protected $fillable = [
        'nama_supplier',
        'kontak',
        'alamat'
    ];

    // Relasi dengan tabel produk
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_supplier', 'id_supplier');
    }
}
