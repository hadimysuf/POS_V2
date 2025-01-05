<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Kategori;


class GudangDashboardController extends Controller
{
    public function index()
    {
        $username = session('username');
        $role = session('role');

        if ($role !== 'pergudangan') {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        // Menghitung data untuk dashboard
        $totalProduk = Produk::count(); // Hitung total produk
        $totalTransaksiMasuk = Transaksi::where('tipe', 'masuk')->count(); // Hitung transaksi masuk
        $stokRendah = Produk::whereColumn('stok', '<=', 'stok_minimum')->get(); // Produk dengan stok rendah

        return view('gudang.dashboard', compact('totalProduk', 'totalTransaksiMasuk', 'stokRendah'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('gudang.masuk', compact('produk'));
    }

    // Fungsi untuk menyimpan barang masuk ke stok dan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk', // Validasi ID produk
            'jumlah' => 'required|integer|min:1',             // Validasi jumlah barang
        ]);

        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($request->id_produk);

        // Tambahkan stok
        $produk->increment('stok', $request->jumlah);

        // Simpan transaksi tipe masuk
        Transaksi::create([
            'tanggal_waktu' => now(),
            'nomor_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'total' => $produk->harga * $request->jumlah,
            'tipe' => 'masuk',
            'created_by' => session('id'),
        ]);

        return redirect()->route('gudang.dashboard')->with('success', 'Barang berhasil ditambahkan ke stok!');
    }

    // Fungsi untuk menampilkan daftar produk
    public function produk()
    {
        $produk = Produk::all(); // Mengambil semua produk
        return view('gudang.produk', compact('produk'));
    }
    public function storeBarangMasuk(Request $request)
    {
        $validatedData = $request->validate([
            'id_produk' => 'nullable|exists:produk,id_produk',
            'nama_produk' => 'nullable|required_if:id_produk,new|string|max:100',
            'harga' => 'nullable|required_if:id_produk,new|numeric|min:0',
            'stok_minimum' => 'nullable|required_if:id_produk,new|integer|min:0',
            'id_kategori' => 'nullable|required_if:id_produk,new|exists:kategori,id_kategori',
            'jumlah' => 'required|integer|min:1',
        ]);

        // Jika produk baru
        if ($request->id_produk === 'new') {
            $produkBaru = Produk::create([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'stok' => $request->jumlah, // Jumlah barang masuk menjadi stok awal
                'stok_minimum' => $request->stok_minimum,
                'id_kategori' => $request->id_kategori,
            ]);

            $idProduk = $produkBaru->id_produk;
        } else {
            $idProduk = $request->id_produk;

            // Update stok produk yang sudah ada
            Produk::where('id_produk', $idProduk)->increment('stok', $request->jumlah);
        }

        // Simpan transaksi barang masuk
        Transaksi::create([
            'tanggal_waktu' => now(),
            'id_produk' => $idProduk,
            'jumlah' => $request->jumlah,
            'jenis_transaksi' => 'masuk',
            'created_by' => auth()->user()->id ?? null, // Pastikan session login aktif
        ]);

        return redirect()->route('gudang.produk.masuk')->with('success', 'Barang masuk berhasil disimpan!');
    }
    public function showBarangMasuk()
    {
        $produk = Produk::all(); // Mengambil semua produk untuk dropdown
        $kategori = Kategori::all(); // Untuk menambah produk baru

        return view('gudang.masuk', compact('produk', 'kategori'));
    }
    public function notifikasiStokRendah()
    {
        $produkStokRendah = Produk::whereColumn('stok', '<=', 'stok_minimum')->get();

        return view('gudang.notifikasi', compact('produkStokRendah'));
    }
}
