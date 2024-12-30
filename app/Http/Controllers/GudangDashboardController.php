<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;

class GudangDashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $barangMasuk = Transaksi::with('details')->where('tipe', 'masuk')
            ->whereDate('tanggal', now())
            ->sum('details.jumlah');

        $barangKeluar = Transaksi::with('details')->where('tipe', 'keluar')
            ->whereDate('tanggal', now())
            ->sum('details.jumlah');
        $produk = Produk::all();

        return view('gudang.dashboard', compact('totalProduk', 'barangMasuk', 'barangKeluar', 'produk'));
    }

    public function notifikasi()
    {
        $produk_minimum = Produk::where('stok', '<=', 10)->get();
        return view('gudang.notifikasi', compact('produk_minimum'));
    }

    public function transaksi(Request $request)
    {
        $query = Transaksi::with('produk');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $transaksi = $query->get();
        return view('gudang.transaksi', compact('transaksi'));
    }
}
