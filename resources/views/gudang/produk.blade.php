@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Stok</th>
                <th>Stok Minimum</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $p)
            <tr>
                <td>{{ $p->id_produk }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ $p->stok }}</td>
                <td>{{ $p->stok_minimum }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
