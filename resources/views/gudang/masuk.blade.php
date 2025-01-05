@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Input Barang Masuk</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('gudang.masuk.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_produk">Pilih Produk</label>
            <select name="id_produk" id="id_produk" class="form-control">
                <option value="">Pilih Produk</option>
                @foreach($produk as $item)
                    <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}</option>
                @endforeach
                <option value="new">Tambah Produk Baru</option>
            </select>
        </div>

        <div id="new-product-fields" style="display: none;">
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="form-control">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" id="harga" class="form-control">
            </div>
            <div class="form-group">
                <label for="stok_minimum">Stok Minimum</label>
                <input type="number" name="stok_minimum" id="stok_minimum" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('id_produk').addEventListener('change', function () {
        const isNewProduct = this.value === 'new';
        document.getElementById('new-product-fields').style.display = isNewProduct ? 'block' : 'none';
    });
</script>
@endsection
