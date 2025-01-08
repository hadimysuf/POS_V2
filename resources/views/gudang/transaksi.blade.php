@extends('layouts.gudang')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Daftar Transaksi</h1>
        <!-- Transaksi Masuk -->
        <h2>Transaksi Masuk</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal & Waktu</th>
                    <th>Nomor Transaksi</th>
                    <th>Total</th>
                    <th>Nama User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksiMasuk as $transaksi)
                    <tr>
                        <td>{{ $transaksi->id_transaksi }}</td>
                        <td>{{ $transaksi->tanggal_waktu }}</td>
                        <td>{{ $transaksi->nomor_transaksi }}</td>
                        <td>{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td>{{ $transaksi->nama_user ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
