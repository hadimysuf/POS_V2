@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ $username }}!</p>

    <div class="row">
        <!-- Total Pengguna -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Total Produk -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi</h5>
                    <p class="card-text">{{ $totalTransactions }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk dengan Stok Rendah -->
    <h3>Produk dengan Stok Rendah</h3>
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
