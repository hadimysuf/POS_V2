<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    public function index(Request $request) // Tambahkan Request $request
    {
        // Inisialisasi query untuk model Transaksi
        $query = Transaksi::query();

        // Ambil parameter pencarian dari request
        if ($request->has('search') && $request->search) {
            $search = $request->search;

            // Validasi apakah input berbentuk tanggal
            $isDate = strtotime($search) !== false;

            // Pencarian berdasarkan nama pembeli atau nomor transaksi
            $query->where('nama_pembeli', 'like', '%' . $search . '%')
                ->orWhere('nomor_transaksi', 'like', '%' . $search . '%');

            // Pencarian berdasarkan tanggal jika input berupa tanggal
            if ($isDate) {
                $date = date('Y-m-d', strtotime($search)); // Ambil hanya tanggalnya (tanpa waktu)
                $query->orWhereDate('tanggal_waktu', $date); // Bandingkan hanya bagian tanggalnya saja
            }
        }

        // Ambil data transaksi (semua atau hasil pencarian)
        $transactions = $query->get();

        return view('kasir.history.show', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transaksi::with('details')->findOrFail($id);

        return view('kasir.history.detail', compact('transaction'));
    }

    public function showReceipt($id)
    {
        $transaction = Transaksi::with('details.produk')->findOrFail($id);

        return view('kasir.history.receipt', compact('transaction'));
    }
}
