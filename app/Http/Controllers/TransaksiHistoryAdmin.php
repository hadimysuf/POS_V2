<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Transaksidetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class TransaksiHistoryAdmin extends Controller
{
    public function index(Request $request)
    {
        // Ambil data semua transaksi, urut berdasarkan tanggal dan ID
        $transactions = Transaksi::orderBy('tanggal_waktu', 'desc')
            ->orderBy('id_transaksi')
            ->where('tipe', 'keluar')
            ->get();
            

        // Total pemasukan per hari
        $totalPerDay = Transaksi::selectRaw('DATE(tanggal_waktu) as tanggal, SUM(total) as total_pemasukan')
            ->groupBy(DB::raw('DATE(tanggal_waktu)'))
            ->orderBy('tanggal', 'desc')
            ->get()
            ->pluck('total_pemasukan', 'tanggal')
            ->toArray();

        return view('admin.history.index', compact('transactions', 'totalPerDay'));
    }

    public function filterByDate($date)
    {
        // Filter transaksi berdasarkan tanggal tertentu
        $transactions = Transaksi::whereDate('tanggal_waktu', $date)
            ->orderBy('tanggal_waktu', 'desc')
            ->get();

        return response()->json($transactions);
    }
    public function show($id)
    {
        // Ambil transaksi
        $transaksi = Transaksi::findOrFail($id);

        // Ambil detail produk
        $details = TransaksiDetail::with('produk')
            ->where('id_transaksi', $id)
            ->get();

        return view('admin.history.show', compact('transaksi', 'details'));
    }
    public function print($date)
    {
        // Ambil data transaksi berdasarkan tanggal
        $transactions = Transaksi::whereDate('tanggal_waktu', $date)->orderBy('id_transaksi')->get();

        // Hitung total pemasukan harian
        $totalPemasukanHarian = $transactions->sum('total');

        // Kirim data ke view
        return view('admin.history.print', compact('transactions', 'totalPemasukanHarian', 'date'));
    }
}
