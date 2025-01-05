<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;


    protected $table = 'kategori'; // Pastikan nama tabel benar
    protected $primaryKey = 'id_kategori'; // Pastikan primary key sesuai
    protected $fillable = ['nama_kategori']; // Kolom yang dapat diisi

}
