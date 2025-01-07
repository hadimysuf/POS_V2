@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
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

        .form-control,
        .btn {
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control {
            background: var(--background-dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        .form-control:focus {
            background: var(--background-dark);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
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

        .date-navigation {
            background: rgba(79, 70, 229, 0.05);
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .gradient-text {
            font-size: 1.75rem;
            margin-bottom: 0;
            font-weight: 600;
        }

        .filter-section {
            background: rgba(79, 70, 229, 0.03);
            border-radius: 0.5rem;
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .table-date-header {
            background: rgba(79, 70, 229, 0.05);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .btn-sm {
            padding: 0.4rem 0.75rem;
            font-size: 0.875rem;
        }

        .action-button {
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .total-row td {
            font-weight: 600;
            letter-spacing: 0.025em;
        }
    </style>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="gradient-text text-white mb-0">Riwayat Transaksi</h5>
        </div>

        <div class="card-body">

            <div class="date-navigation">
                <p class="text-secondary mb-2">Pilih tanggal transaksi</p>
                <div class="d-flex gap-3 mb-3">
                    <a href="{{ route('history.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-sync-alt me-2"></i>Reset Filter
                    </a>
                </div>
                <div class="filter-section">
                    <form id="filterForm" action="{{ route('history.index') }}" method="GET" class="row g-3 "
                        onsubmit="filterTransactions(event)">
                        <div class="col-md-3">
                            <select name="month" class="form-control" id="month">
                                <option value="" class="text-secondary">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option class="text-secondary" value="{{ $i }}"
                                        {{ request('month') == $i ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $i, 10)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="year" class="form-control" id="year">
                                <option class="text-secondary" value="">Pilih Tahun</option>
                                @foreach (range(2020, date('Y')) as $year)
                                    <option class="text-secondary" value="{{ $year }}"
                                        {{ request('year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary" onclick="this.form.submit()">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                        </div>
                        <div class="col-md-3">
                            @if (request('month') && request('year'))
                                <a href="{{ route('admin.history.printMonth', ['month' => request('month'), 'year' => request('year')]) }}"
                                    class="btn btn-outline-secondary">
                                    <i class="fas fa-print me-2"></i>Cetak Bulan & Tahun
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div id="transaction-container">
                @php $current_date = ''; @endphp
                @foreach ($transactions as $transaction)
                    @php $date = \Carbon\Carbon::parse($transaction->tanggal_waktu)->format('Y-m-d'); @endphp

                    @if ($date != $current_date)
                        @if ($current_date != '')
                            </tbody>
                            <tfoot>
                                <tr class="total-row">
                                    <td colspan="5" class="text-end"><strong>Total Pemasukan:</strong></td>
                                    <td><strong>Rp
                                            {{ number_format($totalPerDay[$current_date] ?? 0, 0, ',', '.') }}</strong></td>
                                    <td>
                                        <a href="{{ route('admin.history.print', ['date' => $current_date]) }}"
                                            class="btn btn-outline-secondary btn-sm action-button">
                                            <i class="fas fa-print"></i>
                                            <span>Cetak</span>
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                            </table>
            </div>
            @endif

            <div class="table-responsive mb-4" data-date="{{ $date }}">
                <div class="table-date-header">
                    {{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM Y') }}
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Waktu</th>
                                <th>No. Transaksi</th>
                                <th>No. Customer</th>
                                <th>Kasir</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @endif

                            <tr>
                                <td>{{ $transaction->id_transaksi }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->tanggal_waktu)->format('H:i') }}</td>
                                <td>{{ $transaction->nomor_transaksi }}</td>
                                <td>{{ $transaction->no_customer }}</td>
                                <td>{{ $transaction->nama_user }}</td>
                                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.show', ['id' => $transaction->id_transaksi]) }}"
                                        class="btn btn-dark btn-outline-secondary btn-sm action-button">
                                        <i class="fas fa-eye"></i>
                                        <span>Detail</span>
                                    </a>
                                </td>
                            </tr>

                            @php $current_date = $date; @endphp
                            @endforeach

                            @if ($current_date != '')
                        </tbody>
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="5" class="text-end"><strong>Total Pemasukan:</strong></td>
                                <td><strong>Rp {{ number_format($totalPerDay[$current_date] ?? 0, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    <a href="{{ route('admin.history.print', ['date' => $current_date]) }}"
                                        class="btn btn-outline-secondary btn-sm action-button">
                                        <i class="fas fa-print"></i>
                                        <span>Cetak</span>
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
