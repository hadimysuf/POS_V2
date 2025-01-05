@extends('layouts.gudang')

@section('content')
<div class="container">
    <h1>Daftar Transaksi Gudang</h1>
    <a href="{{ route('pergudangan.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Jenis Transaksi</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->produk->nama_produk }}</td>
                    <td>{{ $t->jumlah }}</td>
                    <td>{{ $t->jenis_transaksi }}</td>
                    <td>{{ $t->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
