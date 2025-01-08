@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Transaksi Gudang</h1>
    <form action="{{ route('pergudangan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_produk" class="form-label">Pilih Produk</label>
            <select name="id_produk" id="id_produk" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($produk as $p)
                    <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi" id="jenis_transaksi" class="form-control" required>
                <option value="barang masuk">Barang Masuk</option>
                <option value="barang keluar">Barang Keluar</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
