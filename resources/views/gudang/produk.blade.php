@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>

    @if($produk->isEmpty())
        <p>Tidak ada produk tersedia.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $item)
                    <tr>
                        <td>{{ $item->nama_produk }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>{{ $item->stok }}</td>
                        <td>{{ $item->satuan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('gudang.dashboard') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
