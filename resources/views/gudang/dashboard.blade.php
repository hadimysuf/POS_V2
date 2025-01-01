@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin Gudang</h1>

    <div class="row mt-4">
        <!-- Informasi Stok Rendah -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Stok Rendah</h5>
                    <p class="card-text">Total Produk dengan Stok Rendah: <strong>{{ $stokRendah->count() }}</strong></p>
                    <ul class="list-group">
                        @foreach ($stokRendah as $produk)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $produk->nama_produk }}
                                <span class="badge bg-danger">{{ $produk->stok }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Informasi Total Produk -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Produk</h5>
                    <p class="card-text">Jumlah Semua Produk: <strong>{{ $totalProduk }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Informasi Total Transaksi Gudang -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Transaksi Gudang</h5>
                    <p class="card-text">Jumlah Semua Transaksi: <strong>{{ $totalTransaksi }}</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan Data Transaksi Gudang -->
    <div class="mt-5">
        <h2>Tambah Transaksi Pergudangan</h2>
        <form action="{{ route('pergudangan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="produk_id" class="form-label">Produk</label>
                <select name="produk_id" id="produk_id" class="form-select" required>
                    <option value="">Pilih Produk</option>
                    @foreach ($stokRendah as $produk)
                        <option value="{{ $produk->id_produk }}">{{ $produk->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan Transaksi</button>
        </form>
    </div>
</div>
@endsection
