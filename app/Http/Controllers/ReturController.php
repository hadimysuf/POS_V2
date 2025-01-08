<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class ReturController extends Controller
{
    public function create($id_transaksi)
    {
        $transaction = Transaksi::with('details')->findOrFail($id_transaksi);

        return view('kasir.retur.create', compact('transaction'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'id_produk' => 'required|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'alasan' => 'required|string|max:255',
        ]);

        // Proses logika retur (misalnya menyimpan ke tabel retur jika ada)
        $transactionDetail = TransaksiDetail::where('id_transaksi', $validatedData['id_transaksi'])
            ->where('id_produk', $validatedData['id_produk'])
            ->first();

        if ($transactionDetail) {
            $transactionDetail->jumlah -= $validatedData['jumlah'];
            $transactionDetail->save();
        }

        return redirect()->route('kasir.history.index')->with('success', 'Proses retur berhasil!');
    }
}
