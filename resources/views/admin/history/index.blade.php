@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Transaction History</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Transaction Number</th>
                    <th>Total</th>
                    <th>User</th>
                    <th>Paid</th>
                    <th>Change</th>
                    <th>Customer No</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id_transaksi }}</td>
                        <td>{{ $transaction->tanggal_waktu }}</td>
                        <td>{{ $transaction->nomor_transaksi }}</td>
                        <td>{{ $transaction->total }}</td>
                        <td>{{ $transaction->nama_user }}</td>
                        <td>{{ $transaction->bayar }}</td>
                        <td>{{ $transaction->kembali }}</td>
                        <td>{{ $transaction->no_customer }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
