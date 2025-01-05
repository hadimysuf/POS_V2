@extends('layouts.admin')

@section('content')
    <style>
        .table {
            color: var(--text-primary);
        }

        .table thead th {
            background: rgba(79, 70, 229, 0.1);
            color: var(--text-primary);
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding: 1rem;
        }

        .table tbody th {
            border-color: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            vertical-align: middle;
            background-color: rgba(255, 255, 255, 0.1);
            /* Set background to black */
            color: #f4f4f4;
            /* Set text color to white for contrast */
        }

        .table tbody td {
            border-color: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            vertical-align: middle;
            background-color: rgba(255, 255, 255, 0.1);
            /* Set background to black */
            color: #f4f4f4;
            /* Set text color to white for contrast */
        }

        .table tfoot td {
            background: rgba(215, 213, 251, 0.1);
            color: rgb(112, 156, 47);
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding: 1rem;
        }


        .table tbody tr:hover {
            background: rgba(79, 70, 229, 0.05);
        }
    </style>
    <div class="container mt-3 ms-2">
        <h1>Detail Transaksi</h1>
        <table class="table table-bordered text-white">
            <tr>
                <th>ID Transaksi</th>
                <td>{{ $transaksi->id_transaksi }}</td>
            </tr>
            <tr>
                <th>Tanggal Waktu</th>
                <td>{{ $transaksi->tanggal_waktu }}</td>
            </tr>
            <tr>
                <th>Nomor Transaksi</th>
                <td>{{ $transaksi->nomor_transaksi }}</td>
            </tr>
            <tr>
                <th>Nomor Customer</th>
                <td>{{ $transaksi->no_customer }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ $transaksi->total }}</td>
            </tr>
            <tr>
                <th>Nama Kasir</th>
                <td>default</td>
            </tr>
            <tr>
                <th>Bayar</th>
                <td>{{ $transaksi->bayar }}</td>
            </tr>
            <tr>
                <th>Kembali</th>
                <td>{{ $transaksi->kembali }}</td>
            </tr>
        </table>

        <h2>Detail Produk</h2>
        <table class="table table-bordered text-white">
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->id_produk }}</td>
                        <td>{{ $detail->produk->nama_produk }}</td>
                        <td>{{ $detail->harga }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>{{ $detail->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('history.index') }}" class="btn btn-primary">Kembali</a>
    </div>
@endsection
