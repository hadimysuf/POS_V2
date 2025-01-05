@extends('layouts.app')

@section('content')

<style>
    /* Mengatur warna teks di input jumlah */
    input[type="number"] {
        color: white; /* Mengubah warna teks menjadi putih */
    }

    /* Mengatur warna placeholder agar terlihat lebih terang */
    input[type="number"]::placeholder {
        color: rgba(255, 255, 255, 0.7); /* Warna putih dengan transparansi */
    }

    /* Mengatur warna teks di dropdown produk */
    select {
        color: white; /* Mengubah warna teks menjadi putih */
    }
    
    /* Mengatur warna teks di tabel keranjang */
    table.table {
        color: white; /* Mengubah warna teks menjadi putih */
    }

    /* Mengatur warna teks pada header tabel */
    table.table th {
        color: white; /* Mengubah warna teks header menjadi putih */
    }

    /* Mengatur warna teks pada body tabel */
    table.table td {
        color: white; /* Mengubah warna teks isi tabel menjadi putih */
    }
</style>


<div class="container">
    <h1>Kasir</h1>

    <!-- Form untuk Menambahkan Produk ke Keranjang -->
    <form action="{{ route('kasir.addToCart') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
            <select name="id_produk" class="form-control" required>
                <option value="">Pilih Produk</option>
                @foreach ($produk as $p)
                    <option value="{{ $p->id_produk }}">{{ $p->nama_produk }} - Rp {{ number_format($p->harga, 0, ',', '.') }}</option>
                @endforeach
            </select>
            <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required min="1">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>

    <!-- Tampilkan Keranjang -->
    <h2>Keranjang</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $item)
                    <tr>
                        <td>{{ $item['nama_produk'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                    </tr>
                    @php $total += $item['harga'] * $item['jumlah']; @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">Keranjang kosong</td>
                </tr>
            @endif
        </tbody>
    </table>



    <!-- Tampilkan Total dan Form Pembayaran -->
    <h3>Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
    <form action="{{ route('kasir.checkout') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_pembeli">Nama Pembeli</label>
            <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bayar" class="form-label">Uang Pembayaran:</label>
            <input type="number" name="bayar" class="form-control" required min="{{ $total }}">
        </div>
        <button type="submit" class="btn btn-success">Checkout</button>
    </form>

    <!-- Tombol Reset Keranjang -->
    <form action="{{ route('kasir.resetCart') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger">Reset Keranjang</button>
    </form>
</div>

<div class="container">
    <!-- Tombol ke halaman history transaksi -->
    <a href="{{ route('kasir.history') }}" class="btn btn-primary mt-3">Lihat Riwayat Transaksi</a>
</div>
@endsection
