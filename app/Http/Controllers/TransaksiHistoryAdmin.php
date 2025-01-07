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
        $month = $request->input('month');
        $year = $request->input('year');
        $date = $request->input('date'); // Ambil tanggal dari input

        // Inisialisasi query untuk mengambil transaksi
        $query = Transaksi::where('tipe', 'keluar')
            ->orderBy('tanggal_waktu', 'desc')
            ->orderBy('id_transaksi');

        // Jika bulan dan tahun dipilih, tambahkan filter
        if ($month && $year) {
            $query->whereYear('tanggal_waktu', $year)
                ->whereMonth('tanggal_waktu', $month);
        }

        // Jika hanya tanggal dipilih, tambahkan filter berdasarkan tanggal
        if ($date) {
            $query->whereDate('tanggal_waktu', $date);
        }

        // Ambil transaksi yang sesuai dengan filter
        $transactions = $query->get();

        // Menghitung total penghasilan per bulan
        $totalPerMonth = $transactions->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->tanggal_waktu)->format('Y-m');
        })
            ->map(function ($item) {
                return $item->sum('total');
            });

        // Menghitung total pemasukan per hari
        $totalPerDay = Transaksi::where('tipe', 'keluar')
            ->selectRaw('DATE(tanggal_waktu) as tanggal, SUM(total) as total_pemasukan')
            ->groupBy(DB::raw('DATE(tanggal_waktu)'))
            ->orderBy('tanggal', 'desc')
            ->get()
            ->pluck('total_pemasukan', 'tanggal')
            ->toArray();

        return view('admin.history.index', compact('transactions', 'totalPerDay', 'totalPerMonth'));
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
        $transactions = Transaksi::whereDate('tanggal_waktu', $date)
            ->orderBy('id_transaksi')
            ->get();

        // Hitung total pemasukan harian
        $totalPemasukanHarian = $transactions->sum('total');

        // Kirim data ke view
        return view('admin.history.print', compact('transactions', 'totalPemasukanHarian', 'date'));
    }

    public function printByMonthYear($month, $year)
    {
        // Ambil data transaksi berdasarkan bulan dan tahun yang dipilih
        $transactions = Transaksi::whereYear('tanggal_waktu', $year)
            ->whereMonth('tanggal_waktu', $month)
            ->where('tipe', 'keluar')
            ->orderBy('id_transaksi')
            ->get();

        // Hitung total pemasukan berdasarkan bulan
        $totalPemasukanBulanan = $transactions->sum('total');

        // Kirim data ke view
        return view('admin.history.printMonth', compact('transactions', 'totalPemasukanBulanan', 'month', 'year'));
    }
}
