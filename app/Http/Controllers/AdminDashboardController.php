<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Supplier;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $username = session('username');
        $role = session('role');

        // Pastikan hanya admin yang dapat mengakses
        if ($role !== 'admin') {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        // Data untuk dashboard
        $totalUsers = User::count(); // Total pengguna
        $totalProducts = Produk::count(); // Total produk
        $totalTransactions = Transaksi::where('tipe', 'keluar')->count(); // Total transaksi penjualan
        $stokRendah = Produk::whereColumn('stok', '<', 'stok_minimum')->get(); // Produk dengan stok rendah

        return view('admin.dashboard', compact('username', 'role', 'totalUsers', 'totalProducts', 'totalTransactions', 'stokRendah'));
    }

    public function tambahProduk()
    {
        $suppliers = Supplier::all(); // Ambil semua data supplier
        return view('admin.products.create', compact('suppliers'));
    }

    public function simpanProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'id_kategori' => 'required|integer|exists:kategori,id_kategori',
            'stok_minimum' => 'required|integer|min:0',
        ]);

        // Simpan data ke tabel produk
        Produk::create($request->all());

        return redirect()->route('admin.produk')->with('success', 'Produk berhasil ditambahkan!');
    }
}
