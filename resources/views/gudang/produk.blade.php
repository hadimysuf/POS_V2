@extends('layouts.gudang')

@section('content')
    <div class="container">
        <h1>Daftar Produk</h1>
        <a href="{{ route('gudang.produk.create') }}" class="btn btn-primary mb-2">Tambah Produk</a>

        @if ($produk->isEmpty())
            <p class="" >Tidak ada produk tersedia.</p>
        @else
            <table class="table table-bordered text-white">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $item)
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
    </div>
@endsection
