<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Supplier; // Tambahkan model Supplier

class AdminDashboardController extends Controller
{
    public function index()
    {
        $username = session('username');
        $role = session('role');

        if ($role !== 'admin') {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        return view('admin.dashboard', compact('username', 'role'));
    }

    public function tambahProduk()
    {
        $supplier = Supplier::all(); // Ambil semua data supplier
        return view('produk.create', compact('supplier'));
    }


    public function simpanProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'kategori' => 'required|string|max:50',
        ]);

        // Simpan data ke tabel produk
        Produk::create($request->all());

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan!');
    }
}
