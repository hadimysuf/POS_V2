@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Data Penjualan</h1>
        <style>
            .card {
                background: var(--background-light);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 0.75rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                background: rgba(79, 70, 229, 0.1);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding: 1.25rem 1.75rem;
                border-radius: 0.75rem 0.75rem 0 0;
            }

            .table-container {
                border-radius: 0.5rem;
                overflow: hidden;
                margin: 1rem 0;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            }

            .table {
                color: var(--text-primary);
                margin-bottom: 0;
            }

            .table thead th {
                background: rgba(79, 70, 229, 0.1);
                color: var(--text-primary);
                border-bottom: 2px solid rgba(255, 255, 255, 0.1);
                padding: 1rem;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.875rem;
                letter-spacing: 0.025em;
            }

            .table tbody td {
                border-color: rgba(255, 255, 255, 0.1);
                padding: 1rem;
                vertical-align: middle;
                background-color: rgba(255, 255, 255, 0.1);
                color: #f4f4f4;
                font-size: 0.95rem;
                transition: background-color 0.2s ease;
            }

            .table tfoot td {
                background: rgba(215, 213, 251, 0.1);
                color: rgb(112, 156, 47);
                border-bottom: 2px solid rgba(255, 255, 255, 0.1);
                padding: 1rem;
                font-weight: 600;
            }

            .table tbody tr:hover td {
                background: rgba(79, 70, 229, 0.08);
            }


            .btn {
                font-weight: 500;
                letter-spacing: 0.025em;
            }

            .btn-outline-secondary {
                color: var(--text-primary);
                border-color: rgba(255, 255, 255, 0.2);
            }

            .btn-outline-secondary:hover {
                background: rgba(79, 70, 229, 0.1);
                color: var(--text-primary);
                border-color: rgba(255, 255, 255, 0.3);
            }

        </style>

        <!-- Filter Tanggal -->
        <form method="GET" action="{{ route('data_penjualan.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ $startDate ?? '' }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ $endDate ?? '' }}" required>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Produk Terlaris -->
        <h2>Produk Paling Laris</h2>
        @if ($dataTerlaris)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Total Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $dataTerlaris->nama_produk }}</td>
                        <td>{{ $dataTerlaris->total_terjual }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>Tidak ada data produk terlaris dalam rentang waktu ini.</p>
        @endif

        <!-- Produk Kurang Laku -->
        <h2>Produk Paling Kurang Laku</h2>
        @if ($dataKurangLaku)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Total Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $dataKurangLaku->nama_produk }}</td>
                        <td>{{ $dataKurangLaku->total_terjual }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>Tidak ada data produk kurang laku dalam rentang waktu ini.</p>
        @endif

        <!-- Detail Penjualan -->
        <h2>Detail Penjualan</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total Per Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($detailProduk) && count($detailProduk) > 0)
                    @foreach ($detailProduk as $detail)
                        <tr>
                            <td>{{ $detail->nama_produk }}</td>
                            <td>{{ $detail->tanggal_penjualan }}</td>
                            <td>{{ $detail->total_per_tanggal }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data penjualan untuk rentang waktu ini.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Tombol Cetak -->
        <a href="{{ route('data_penjualan.cetak', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
            class="btn btn-primary" target="_blank">Cetak</a>
    </div>
@endsection
