@extends('layouts.gudang')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Data Produk Gudang</h1>
    <a href="{{ route('gudang.produk.create') }}" class="btn btn-primary mb-2">Tambah Produk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok Awal</th>
                <th>Stok Masuk</th>
                <th>Stok Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $item)
            <tr>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->kategori->nama_kategori ?? 'Tidak Ada' }}</td>
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->stok_awal }}</td>
                <td>{{ $item->stok_masuk }}</td>
                <td>{{ $item->stok }}</td> <!-- Stok Total -->
                <td>
                    <a href="{{ route('gudang.produk.edit', $item->id_produk) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('gudang.produk.destroy', $item->id_produk) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
