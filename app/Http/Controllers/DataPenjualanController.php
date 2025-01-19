<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataPenjualanController extends Controller
{
    /**
     * Tampilkan halaman data penjualan dengan default data produk terlaris dan kurang laku.
     */
    public function index(Request $request)
    {
        // Ambil tanggal dari filter
        $startDate = $request->input('start_date', now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Produk terlaris berdasarkan filter tanggal
        $dataTerlaris = DB::table('transaksi_detail')
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('SUM(transaksi_detail.jumlah) as total_terjual'))
            ->whereBetween('transaksi_detail.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk')
            ->orderByDesc('total_terjual')
            ->take(5) // Ambil 5 produk terlaris
            ->get();

        // Produk kurang laku berdasarkan filter tanggal
        $dataKurangLaku = DB::table('transaksi_detail')
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('SUM(transaksi_detail.jumlah) as total_terjual'))
            ->whereBetween('transaksi_detail.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk')
            ->orderBy('total_terjual', 'asc')
            ->take(5) // Ambil 5 produk kurang laku
            ->get();

        // Detail produk berdasarkan tanggal
        $detailProduk = DB::table('transaksi_detail')
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('DATE(transaksi_detail.created_at) as tanggal_penjualan'), DB::raw('SUM(transaksi_detail.jumlah) as total_per_tanggal'))
            ->whereBetween('transaksi_detail.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk', DB::raw('DATE(transaksi_detail.created_at)'))
            ->orderBy('tanggal_penjualan')
            ->get();

        return view('admin.data_penjualan', compact('dataTerlaris', 'dataKurangLaku', 'detailProduk', 'startDate', 'endDate'));
    }

    public function filter(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Produk terlaris berdasarkan filter tanggal
        $dataTerlaris = DB::table('transaksi_detail')
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('SUM(transaksi_detail.jumlah) as total_terjual'))
            ->whereBetween('transaksi_detail.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->get();

        // Produk kurang laku berdasarkan filter tanggal
        $dataKurangLaku = DB::table('transaksi_detail')
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('SUM(transaksi_detail.jumlah) as total_terjual'))
            ->whereBetween('transaksi_detail.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk')
            ->orderBy('total_terjual', 'asc')
            ->take(5)
            ->get();

        // Detail produk berdasarkan tanggal
        $detailProduk = DB::table('transaksi_detail')
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('DATE(transaksi_detail.created_at) as tanggal_penjualan'), DB::raw('SUM(transaksi_detail.jumlah) as total_per_tanggal'))
            ->whereBetween('transaksi_detail.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk', DB::raw('DATE(transaksi_detail.created_at)'))
            ->orderBy('tanggal_penjualan')
            ->get();

        return view('admin.data_penjualan', compact('dataTerlaris', 'dataKurangLaku', 'detailProduk', 'startDate', 'endDate'));
    }


    /**
     * Cetak data penjualan berdasarkan filter waktu.
     */
    public function cetak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data penjualan berdasarkan filter waktu
        $detailProduk = DB::table('transaksi_detail')
            ->join('produk', 'transaksi_detail.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('DATE(transaksi_detail.created_at) as tanggal_penjualan'), DB::raw('SUM(transaksi_detail.jumlah) as total_per_tanggal'))
            ->whereBetween('transaksi_detail.created_at', [$startDate, $endDate])
            ->groupBy('produk.nama_produk', DB::raw('DATE(transaksi_detail.created_at)'))
            ->orderBy('produk.nama_produk')
            ->orderBy('tanggal_penjualan')
            ->get();

        // Grouping data by product name
        $groupedData = [];
        foreach ($detailProduk as $data) {
            $groupedData[$data->nama_produk][] = $data;
        }

        // Return view cetak
        return view('admin.data_penjualan_cetak', compact('groupedData', 'startDate', 'endDate'));
    }
}
