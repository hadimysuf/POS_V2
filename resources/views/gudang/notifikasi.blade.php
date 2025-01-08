@extends('layouts.gudang')

@section('content')
<div class="container">
    <h1>Notifikasi Stok Rendah</h1>

    @if($produkStokRendah->isEmpty())
        <p>Tidak ada produk dengan stok rendah.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Stok</th>
                    <th>Stok Minimum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produkStokRendah as $produk)
                    <tr>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>{{ $produk->stok_minimum }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
