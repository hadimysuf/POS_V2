@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
    <style>
        .card {
            background: var(--background-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
        }

        .card-header {
            background: rgba(79, 70, 229, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1rem 1.5rem;
        }

        ..table {
            color: var(--text-primary);
        }

        .table thead th {
            background: rgba(79, 70, 229, 0.1);
            color: var(--text-primary);
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            padding: 1rem;
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

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
        }

        .btn-primary:hover {
            background: var(--secondary-color);
        }

        .btn-warning {
            background: #f59e0b;
            border: none;
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
            color: white;
        }

        .btn-danger {
            background: #dc2626;
            border: none;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .alert {
            background: rgba(79, 70, 229, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            border-radius: 0.5rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.2);
        }

        .gradient-text {

            font-size: 1.75rem;
            margin-bottom: 0;
        }
    </style>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 gradient-text text-white ">Daftar Produk</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id_produk }}</td>
                                <td>{{ $product->nama_produk }}</td>
                                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td>{{ $product->stok }}</td>
                                <td>{{ $product->satuan }}</td>
                                <td>{{ $product->kategori ? $product->kategori->nama_kategori : '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('produk.destroy', $product) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
