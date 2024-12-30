@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Transaksi Barang Masuk & Keluar</h1>

    <!-- Filter Tanggal -->
    <form action="{{ route('gudang.transaksi') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <select name="tipe" class="form-control">
                    <option value="">Semua</option>
                    <option value="masuk" {{ request('tipe') == 'masuk' ? 'selected' : '' }}>Barang Masuk</option>
                    <option value="keluar" {{ request('tipe') == 'keluar' ? 'selected' : '' }}>Barang Keluar</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Daftar Transaksi -->
    <table class="table table-bordered">
        <thead class="table-secondary">
            <tr>
                <th>Tanggal</th>
                <th>Tipe</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $t)
            <tr>
                <td>{{ $t->tanggal }}</td>
                <td>{{ $t->tipe }}</td>
                <td>{{ $t->produk->nama_produk }}</td>
                <td>{{ $t->jumlah }}</td>
                <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
