@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Riwayat Transaksi Hari Ini</h1>

    @if($transactions->isEmpty())
        <p class="text-center">Tidak ada transaksi hari ini.</p>
    @else
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Nama Pembeli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->nomor_transaksi }}</td>
                        <td>{{ $transaction->tanggal_waktu }}</td>
                        <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td>{{ $transaction->no_customer }}</td>
                        <td>
                            <a href="{{ route('kasir.history.show', $transaction->id_transaksi) }}" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
