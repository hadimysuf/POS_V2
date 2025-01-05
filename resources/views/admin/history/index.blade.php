@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

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

        .table {
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


        .input-group .form-control {
            background: var(--background-dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        .input-group .form-control:focus {
            background: var(--background-dark);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }

        .input-group .btn {
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        .input-group .btn:hover {
            background: rgba(79, 70, 229, 0.1);
        }

        .btn-outline-secondary {
            color: var(--text-primary);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .btn-outline-secondary:hover {
            background: rgba(79, 70, 229, 0.1);
            color: var(--text-primary);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .total-row {
            background: rgba(79, 70, 229, 0.05);
        }

        .gradient-text {

            font-size: 1.75rem;
            margin-bottom: 0;
        }
    </style>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="gradient-text text-white mb-0">Riwayat Transaksi</h5>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <p class="text-secondary mb-2">Pilih tanggal transaksi</p>
                <div class="input-group" style="max-width: 400px;">
                    <button class="btn btn-outline-secondary" onclick="previousDate()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <input type="date" class="form-control" id="datePicker" onchange="filterByDate()">
                    <button class="btn btn-outline-secondary" onclick="nextDate()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
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
                                            class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-print me-1"></i>Cetak
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                            </table>
            </div>
            @endif

            <div class="table-responsive mb-4" data-date="{{ $date }}">
                <h6 class="text-secondary mb-3">{{ \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM Y') }}</h6>
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
                                    class="btn btn-dark btn-outline-secondary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Detail
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
                            <td><strong>Rp {{ number_format($totalPerDay[$current_date] ?? 0, 0, ',', '.') }}</strong></td>
                            <td>
                                <a href="{{ route('admin.history.print', ['date' => $current_date]) }}"
                                    class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-print me-1"></i>Cetak
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

    @push('scripts')
        <script>
            function filterByDate() {
                const selectedDate = document.getElementById("datePicker").value;
                const tables = document.querySelectorAll("#transaction-container .table-responsive");
                tables.forEach(table => {
                    table.style.display = table.getAttribute("data-date") === selectedDate ? "block" : "none";
                });
            }

            function previousDate() {
                const datePicker = document.getElementById("datePicker");
                const currentDate = new Date(datePicker.value);
                datePicker.value = new Date(currentDate.setDate(currentDate.getDate() - 1)).toISOString().split('T')[0];
                filterByDate();
            }

            function nextDate() {
                const datePicker = document.getElementById("datePicker");
                const currentDate = new Date(datePicker.value);
                datePicker.value = new Date(currentDate.setDate(currentDate.getDate() + 1)).toISOString().split('T')[0];
                filterByDate();
            }

            // Set today's date as default
            document.addEventListener('DOMContentLoaded', function() {
                const datePicker = document.getElementById("datePicker");
                datePicker.value = new Date().toISOString().split('T')[0];
                filterByDate();
            });
        </script>
    @endpush
@endsection
