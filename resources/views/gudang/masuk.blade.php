@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Transaksi Barang Masuk</h1>
    <form action="{{ route('gudang.transaksi.simpanMasuk') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_produk" class="form-label">Pilih Produk</label>
            <select name="id_produk" id="id_produk" class="form-control" required>
                <option value="">Pilih Produk</option>
                @foreach($produk as $p)
                <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
</div>
@endsection
