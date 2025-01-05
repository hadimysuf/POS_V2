@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin Gudang</h1>
    <p>Selamat datang, {{ session('username') }}!</p>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text">{{ $totalProduk }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi Masuk</h5>
                    <p class="card-text">{{ $totalTransaksiMasuk }}</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Menu</h3>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('gudang.produk') }}" class="btn btn-primary btn-block">Daftar Produk</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('gudang.produk.masuk') }}" class="btn btn-secondary btn-block">Input Barang Masuk</a>
        </div>
    </div>

    <h3 class="mt-4">Produk dengan Stok Rendah</h3>
    @if($stokRendah->isEmpty())
    <p>Tidak ada produk dengan stok rendah.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Stok Minimum</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stokRendah as $produk)
                <tr>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->stok_minimum }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

</div>
@endsection
