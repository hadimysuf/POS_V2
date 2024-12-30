@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Pergudangan</h1>

    <!-- Ringkasan Statistik -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Total Produk</h5>
                <p class="fs-3">{{ $totalProduk }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Barang Masuk Hari Ini</h5>
                <p class="fs-3">{{ $barangMasuk }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>Barang Keluar Hari Ini</h5>
                <p class="fs-3">{{ $barangKeluar }}</p>
            </div>
        </div>
    </div>

    <!-- Daftar Produk -->
    <h2 class="mt-4">Daftar Produk</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $p)
            <tr>
                <td>{{ $p->kode }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ $p->stok }}</td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('gudang.editProduk', $p->id_produk) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('gudang.deleteProduk', $p->id_produk) }}" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
