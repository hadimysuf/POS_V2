@extends('layouts.app')

@section('content')
<style>
    /* Warna putih untuk teks di dalam tabel */
    table.table td, table.table th {
        color: white;
    }

    /* Warna header tabel */
    table.table th {
        font-weight: bold;
        color: #ffffff;
    }

    /* Warna latar belakang tabel */
    table.table {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Border tabel */
    table.table-bordered {
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    table.table-bordered td, table.table-bordered th {
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Tambahan responsivitas */
    .table-responsive {
        overflow-x: auto;
    }

    .btn-primary, .btn-secondary, .btn-danger {
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <h1 class="text-white">Detail Transaksi</h1>

    <a href="{{ route('retur.create', $transaction->id_transaksi) }}" class="btn btn-danger mb-3">Proses Retur</a>

    <div class="card bg-dark text-white mb-4">
        <div class="card-body">
            <p><strong>No. Transaksi:</strong> {{ $transaction->nomor_transaksi }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->tanggal_waktu }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            <p><strong>Nama Kasir:</strong> {{ $transaction->nama_user }}</p>
        </div>
    </div>

    <h4 class="text-white">Daftar Produk</h4>
    <div class="table-responsive">
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
    </div>

    <div class="d-flex justify-content-between mt-3">
        <a href="{{ route('kasir.history.receipt', $transaction->id_transaksi) }}" class="btn btn-primary">Lihat Struk</a>
        <a href="{{ route('kasir.history.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
