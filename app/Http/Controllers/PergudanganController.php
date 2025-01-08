<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\PergudanganTransaksi;

class PergudanganController extends Controller
{
    // Menampilkan halaman daftar transaksi gudang
    public function index()
    {
        $transaksi = PergudanganTransaksi::with('produk')->get();
        return view('gudang.index', compact('transaksi'));
    }

    // Menampilkan form untuk menambah transaksi gudang
    public function create()
    {
        $produk = Produk::all();
        return view('gudang.create', compact('produk'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|string|in:barang masuk,barang keluar',
        ]);

        PergudanganTransaksi::create([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'jenis_transaksi' => $request->jenis_transaksi,
        ]);

        return redirect()->route('pergudangan.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
