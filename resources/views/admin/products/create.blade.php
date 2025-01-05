@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST">
        @csrf
        <!-- Nama Produk -->
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <!-- Harga Produk -->
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <!-- Stok Produk -->
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>

        <!-- Satuan Produk -->
        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" name="satuan" class="form-control" required>
        </div>

        <!-- Pilih Kategori -->
<div class="mb-3">
    <label for="id_kategori" class="form-label">Kategori</label>
    <select name="id_kategori" class="form-select" required>
        <option value="">Pilih Kategori</option>
        @foreach ($kategori as $k)
            <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
        @endforeach
    </select>
</div>
<!-- Tombol Submit -->
<div class="mt-4">
    <button type="submit" class="btn btn-primary btn-lg w-100 mb-5">
        Tambah Produk
    </button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@endsection
