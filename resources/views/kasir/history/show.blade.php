@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-white">Riwayat Transaksi</h1>

        <!-- Form pencarian -->
        <form action="{{ route('kasir.history.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari transaksi..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>

        @if ($transactions->isEmpty())
            <p class="text-center text-muted">Tidak ada transaksi yang ditemukan.</p>
        @else
            <table class="table table-dark table-striped table-hover table-bordered">
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
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaction->nomor_transaksi }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($transaction->tanggal_waktu)) }}</td>
                            <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            <td>{{ $transaction->nama_pembeli }}</td>
                            <td>
                                <a href="{{ route('kasir.history.show', $transaction->id_transaksi) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('kasir.dashboard') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
