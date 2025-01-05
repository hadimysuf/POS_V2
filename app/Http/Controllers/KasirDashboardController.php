<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;


class KasirDashboardController extends Controller
{
    // Menampilkan halaman dashboard kasir
    public function index()
    {
        $produk = Produk::all();
        return view('kasir.dashboard', compact('produk'));
    }

    // Fungsi untuk menambahkan item ke keranjang
    public function addToCart(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::find($request->id_produk);

        $cart = session()->get('cart', []);
        $id_produk = $produk->id_produk;

        if (isset($cart[$id_produk])) {
            $cart[$id_produk]['jumlah'] += $request->jumlah;
        } else {
            $cart[$id_produk] = [
                'nama_produk' => $produk->nama_produk,
                'harga' => $produk->harga,
                'jumlah' => $request->jumlah,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('kasir.dashboard')->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Fungsi untuk reset keranjang
    public function resetCart()
    {
        session()->forget('cart');
        return redirect()->route('kasir.dashboard')->with('success', 'Keranjang telah dikosongkan!');
    }

    // Fungsi untuk checkout dengan input pembayaran manual dan perhitungan kembalian
    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('kasir.dashboard')->with('error', 'Keranjang kosong.');
        }

        $total = array_sum(array_map(function ($item) {
            return $item['harga'] * $item['jumlah'];
        }, $cart));

        $request->validate([
            'nama_pembeli' => 'required|string|max:255', // Validasi nama pembeli
            'bayar' => 'required|numeric|min:' . $total,

        ]);

        $nomorTransaksi = 'TRX-' . strtoupper(uniqid());
        $tanggalHariIni = now()->format('Y-m-d');
        $noCustomer = Transaksi::whereDate('tanggal_waktu', $tanggalHariIni)->max('no_customer') + 1;

        $transaksi = Transaksi::create([
            'tanggal_waktu' => now(),
            'nomor_transaksi' => $nomorTransaksi,
            'no_customer' => $noCustomer,
            'total' => $total,
            'nama_user' => session('nama_user', 'Kasir Default'),
            'nama_pembeli' => $request->nama_pembeli, // Simpan nama pembeli
            'bayar' => $request->bayar,
            'kembali' => $request->bayar - $total,
            'tipe' => 'keluar', // Tambahkan tipe "keluar" untuk transaksi kasir
            'created_by' => session('id'), // Pastikan session ID pengguna tersimpan
        ]);

        foreach ($cart as $id_produk => $item) {
            TransaksiDetail::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $id_produk,
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
                'total' => $item['harga'] * $item['jumlah'],
            ]);

            Produk::where('id_produk', $id_produk)->decrement('stok', $item['jumlah']);
        }

        session()->forget('cart');

        return redirect()->route('kasir.printReceipt', ['id' => $transaksi->id_transaksi]);
    }

    // Fungsi untuk menampilkan struk
    public function printReceipt($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        return view('kasir.receipt', compact('transaksi'));
    }
}
