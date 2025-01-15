@extends('layouts.gudang')

@section('content')
    <div class="container">
        <h1>Edit Produk</h1>
        <form action="{{ route('produk.update', $produk) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                    value="{{ $produk->nama_produk }}" required>
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}"
                    required>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="{{ $produk->stok }}"
                    required>
            </div>

            <!-- Satuan -->
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $produk->satuan }}"
                    required>
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select class="form-select" id="id_kategori" name="id_kategori" required>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}"
                            {{ $k->id_kategori == $produk->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
