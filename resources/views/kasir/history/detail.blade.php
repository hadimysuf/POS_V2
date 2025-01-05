@extends('layouts.app')

@section('content')
<style>
    

    /* Warna putih untuk teks di dalam tabel */
    table.table td, table.table th {
        color: white; /* Mengubah warna teks menjadi putih */
    }

    /* Jika ingin mengatur warna header tabel lebih jelas */
    table.table th {
        font-weight: bold;
        color: #ffffff; /* Putih */
    }

    /* Warna latar belakang tabel (opsional, jika ingin kontras lebih baik) */
    table.table {
        background-color: rgba(255, 255, 255, 0.1); /* Transparan */
    }

    /* Border tabel (opsional) */
    table.table-bordered {
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    table.table-bordered td, table.table-bordered th {
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
</style>


<div class="container">
    <h1>Detail Transaksi</h1>
    <a href="{{ route('retur.create', $transaction->id_transaksi) }}" class="btn btn-danger mb-3">Proses Retur</a>

    <div class="card mb-4 text-white">
        <div class="card-body ">
            <p><strong>No. Transaksi:</strong> {{ $transaction->nomor_transaksi }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->tanggal_waktu }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            <p><strong>Nama Kasir:</strong> {{ $transaction->nama_user }}</p>
        </div>
    </div>

    <h4>Daftar Produk</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($detail->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('kasir.history.receipt', $transaction->id_transaksi) }}" class="btn btn-primary mt-3">Lihat Struk</a>
    <a href="{{ route('kasir.history.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
