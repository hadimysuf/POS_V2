@extends('layouts.gudang')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Tambah Stok Barang</h1>

    <!-- Alert jika ada pesan sukses -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Form Tambah Stok -->
    <form action="{{ route('gudang.tambah_stok') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="id_produk" class="form-label">Pilih Produk</label>
                <select class="form-select" id="id_produk" name="id_produk" required>
                    <option value="" disabled selected>-- Pilih Produk --</option>
                    @foreach($produk as $item)
                    <option value="{{ $item->id_produk }}">{{ $item->nama_produk }} (Stok: {{ $item->stok }})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="jumlah" class="form-label">Jumlah Barang</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah barang" required min="1">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Stok</button>
    </form>
</div>
@endsection
