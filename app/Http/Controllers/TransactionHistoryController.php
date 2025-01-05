<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        // Ambil transaksi hanya untuk hari ini
        $transactions = Transaksi::whereDate('tanggal_waktu', now()->format('Y-m-d'))->get();

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
