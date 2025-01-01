@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Notifikasi Stok Rendah</h1>
    <ul class="list-group">
        @foreach($stokRendah as $p)
        <li class="list-group-item">
            {{ $p->nama_produk }} (Stok: {{ $p->stok }}, Minimum: {{ $p->stok_minimum }})
        </li>
        @endforeach
    </ul>
</div>
@endsection
    