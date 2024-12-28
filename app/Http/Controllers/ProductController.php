<?php
namespace App\Http\Controllers;

use App\Models\Produk; // Pastikan nama model benar
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
        ]);

        Produk::create($request->all());
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk) // Parameter binding
    {
        return view('admin.products.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'jumlah' => 'required|integer',
        ]);

        $produk->update($request->all());
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
