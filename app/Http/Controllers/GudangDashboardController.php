<?php

namespace App\Http\Controllers;

use App\Models\PergudanganTransaksi;
use Illuminate\Http\Request;
use App\Models\Produk;

class GudangDashboardController extends Controller
{
    public function index()
    {
        $stokRendah = Produk::where('stok', '<', 'stok_minimum')->get();
        $totalProduk = Produk::count();
        $totalTransaksi = PergudanganTransaksi::count(); // Hitung total transaksi

        return view('gudang.dashboard', compact('stokRendah', 'totalProduk', 'totalTransaksi'));
    }
}
