<?php

namespace App\Http\Controllers;

use App\Models\Produk; // Pastikan nama model benar
use Illuminate\Http\Request;
use App\Models\Kategori;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil data produk dengan relasi kategori
        $products = Produk::with('kategori')->get(); // Tambahkan 'with' untuk relasi

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.products.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'stok_minimum' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
        ]);

        // Simpan data produk
        Produk::create([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'stok_minimum' => $request->stok_minimum,
            'satuan' => $request->satuan,

        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }


    public function edit($id)
    {
        // Ambil data produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Ambil data kategori untuk dropdown
        $kategori = Kategori::all();

        // Kirim data produk dan kategori ke view
        return view('admin.products.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'stok_minimum' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
        ]);

        // Temukan produk berdasarkan ID
        $produk = Produk::findOrFail($id);

        // Update data produk
        $produk->update([
            'id_kategori' => $request->id_kategori,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'stok_minimum' => $request->stok_minimum,
            'satuan' => $request->satuan,
        ]);

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }


    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
