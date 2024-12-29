<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // Memanggil Model Produk
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class KasirDashboardController extends Controller
{
    // Menampilkan halaman dashboard kasir
    public function index()
    {
        // Ambil semua data produk dari database
        $produk = Produk::all(); // Pastikan ini mengambil data yang benar

        // Kirim data produk ke view
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

        // Validasi keranjang
        if (empty($cart)) {
            return redirect()->route('kasir.dashboard')->with('error', 'Keranjang kosong.');
        }

        // Hitung total harga
        $total = array_sum(array_map(function ($item) {
            return $item['harga'] * $item['jumlah'];
        }, $cart));

        // Validasi input pembayaran
        $request->validate([
            'bayar' => 'required|numeric|min:' . $total,
        ]);

        // Generate nomor_transaksi (random)
        $nomorTransaksi = 'TRX-' . strtoupper(uniqid()); // Contoh: TRX-65F8C2A1D

        // Hitung no_customer (urut & reset tiap hari)
        $tanggalHariIni = now()->format('Y-m-d');
        $noCustomer = Transaksi::whereDate('tanggal_waktu', $tanggalHariIni)->max('no_customer') + 1;


        // Simpan transaksi utama
        $transaksi = Transaksi::create([
            'tanggal_waktu' => now(),
            'nomor_transaksi' => $nomorTransaksi, // Random nomor transaksi
            'no_customer' => $noCustomer,        // Urut dan reset tiap hari
            'total' => $total,
            'nama_user' => session('nama_user', 'Kasir Default'), // Jika session tidak ada, gunakan default
            'bayar' => $request->bayar,
            'kembali' => $request->bayar - $total, // Hitung kembalian
        ]);

        // Simpan detail transaksi
        foreach ($cart as $id_produk => $item) {
            TransaksiDetail::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $id_produk,
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
                'total' => $item['harga'] * $item['jumlah'],
            ]);

            // Update stok produk
            Produk::where('id_produk', $id_produk)->decrement('jumlah', $item['jumlah']);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        // Redirect ke halaman cetak struk
        return redirect()->route('kasir.printReceipt', ['id' => $transaksi->id_transaksi]);
    }
    // Fungsi untuk menampilkan struk
    public function printReceipt($id)
    {
        $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        return view('kasir.receipt', compact('transaksi'));
    }
}
