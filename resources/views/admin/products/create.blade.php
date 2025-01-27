@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 title-font">Tambah Produk</h1>
        <form action="{{ route('produk.store') }}" method="POST" class="animated-form">
            @csrf
            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control input-effect" required>
            </div>

            <!-- Harga Produk -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control input-effect" required>
            </div>

            <!-- Stok Produk -->
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control input-effect" required>
            </div>

            <!-- Stok Minimum Produk -->
            <div class="mb-3">
                <label for="stok_minimum" class="form-label">Stok Minimum</label>
                <input type="number" name="stok_minimum" class="form-control input-effect" required>
            </div>

            <!-- Satuan Produk -->
            <div class="mb-3">
                <label for="satuan" class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control input-effect" required>
            </div>

            <!-- Pilih Kategori -->
            <div class="mb-3">
                <label for="id_kategori" class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select input-effect" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg w-100 mb-3 btn-animate">
                    Tambah Produk
                </button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary w-100">Kembali</a>
            </div>
        </form>
    </div>
@endsection

<style>


    .title-font {
        font-weight: 600;
        background: linear-gradient(45deg, #4f46e5, #6366f1);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Animasi pada form */
    .animated-form {
        animation: fadeInUp 1s ease-in-out;
    }

    /* Efek input */
    .input-effect {
        position: relative;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .input-effect:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 5px rgba(79, 70, 229, 0.3);
        outline: none;
    }

    /* Animasi pada tombol */
    .btn-animate {
        animation: bounce 0.8s infinite alternate;
    }

    /* Efek hover pada tombol */
    .btn-animate:hover {
        transform: scale(1.01);
    }

    /* Animasi fade in */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Sticker effect */
    .input-effect::after {
        content: '📦';
        /* Sticker icon */
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 18px;
        opacity: 0.3;
        transition: opacity 0.3s ease;
    }

    .input-effect:focus::after {
        opacity: 1;
    }
</style>
