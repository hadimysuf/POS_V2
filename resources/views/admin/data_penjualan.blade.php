@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Data Penjualan</h1>

    <!-- Filter Tanggal -->
    <form method="GET" action="{{ route('data-penjualan.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="start_date">Tanggal Mulai:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate ?? '' }}" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="end_date">Tanggal Akhir:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate ?? '' }}" required>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Produk Terlaris -->
    <h2>Produk Terlaris</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Total Terjual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTerlaris as $produk)
                <tr>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->total_terjual }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Produk Kurang Laku -->
    <h2>Produk Kurang Laku</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Total Terjual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataKurangLaku as $produk)
                <tr>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->total_terjual }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Detail Penjualan -->
    <h2>Detail Penjualan</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Tanggal Penjualan</th>
                <th>Total Per Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($detailProduk) && count($detailProduk) > 0)
                @foreach ($detailProduk as $detail)
                    <tr>
                        <td>{{ $detail->nama_produk }}</td>
                        <td>{{ $detail->tanggal_penjualan }}</td>
                        <td>{{ $detail->total_per_tanggal }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data penjualan untuk rentang waktu ini.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Tombol Cetak -->
    <a href="{{ route('data-penjualan.cetak', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="btn btn-primary" target="_blank">Cetak</a>
</div>
@endsection
