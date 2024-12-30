@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Notifikasi Stok Minimum</h1>

    <!-- Daftar Produk dengan Stok Minimum -->
    <table class="table table-bordered">
        <thead class="table-danger">
            <tr>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk_minimum as $produk)
            <tr>
                <td>{{ $produk->kode }}</td>
                <td>{{ $produk->nama_produk }}</td>
                <td>{{ $produk->stok }}</td>
                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Tidak ada produk dengan stok minimum.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
