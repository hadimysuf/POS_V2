<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function create()
    {
        // Ambil data produk untuk transaksi
        $products = [
            ['id' => 1, 'name' => 'Product A', 'price' => 10000],
            ['id' => 2, 'name' => 'Product B', 'price' => 20000],
        ];

        return view('kasir.sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Simpan transaksi dan data keranjang ke database
        $request->validate([
            'products' => 'required|array',
            'products.*.id' => 'required|integer',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Contoh simpan transaksi
        // Simpan transaksi utama ke database
        // Simpan detail transaksi

        return redirect()->route('sales.receipt')->with('success', 'Transaction completed successfully!');
    }

    public function receipt()
    {
        // Ambil data transaksi terbaru untuk ditampilkan
        return view('kasir.sales.receipt');
    }
}
