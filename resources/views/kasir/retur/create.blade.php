@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Proses Retur Barang</h1>

    <p><strong>No. Transaksi:</strong> {{ $transaction->nomor_transaksi }}</p>
    <p><strong>Tanggal:</strong> {{ $transaction->tanggal_waktu }}</p>

    <form action="{{ route('retur.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_transaksi" value="{{ $transaction->id_transaksi }}">

        <div class="mb-3">
            <label for="id_produk" class="form-label">Pilih Produk</label>
            <select name="id_produk" id="id_produk" class="form-control">
                @foreach ($transaction->details as $detail)
                    <option value="{{ $detail->id_produk }}">{{ $detail->produk->nama_produk }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Retur</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan Retur</label>
            <textarea name="alasan" id="alasan" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Retur</button>
        <a href="{{ route('kasir.history.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
