<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class PergudanganController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->get();
        return view('gudang.produk', compact('produk'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('gudang.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'stok_minimum' => 'nullable|required_if:id_produk,new|integer|min:0',
        ]);

        Produk::create($validatedData);

        return redirect()->route('gudang.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('gudang.produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'nama_produk' => 'required|string|max:100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($validatedData);

        return redirect()->route('gudang.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('gudang.produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
