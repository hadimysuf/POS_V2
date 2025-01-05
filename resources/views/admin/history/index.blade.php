@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1>Riwayat Transaksi</h1>
        <p>Pilih tanggal transaksi</p>
        <div class="input-field input-group mb-3 w-50">
            <button class="btn btn-secondary" onclick="previousDate()">&lt;&lt;</button>
            <input type="date" class="border shadow-sm ps-3" id="datePicker" onchange="filterByDate()" />
            <button class="btn btn-secondary" onclick="nextDate()"> &gt;&gt;</button>
        </div>

        <div id="transaction-container">
            @php $current_date = ''; @endphp
            @foreach ($transactions as $transaction)
                @php $date = \Carbon\Carbon::parse($transaction->tanggal_waktu)->format('Y-m-d'); @endphp

                @if ($date != $current_date)
                    @if ($current_date != '')
                        <tr>
                            <td colspan="5" class="text-end text-success"><b>Total Pemasukan:</b></td>
                            <td><b class="text-success">{{ number_format($totalPerDay[$current_date] ?? 0, 2) }}</b></td>
                            <td><a href="{{ route('admin.history.print', ['date' => $current_date]) }}"
                                    class="btn btn-primary">Cetak Data</a></td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                    @endif

                    <div class="table-responsive" data-date="{{ $date }}">
                        <h2>{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h2>
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Waktu Transaksi</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Nomor Customer</th>
                                    <th>Nama Kasir</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                @endif

                <tr>
                    <th>{{ $transaction->id_transaksi }}</th>
                    <td>{{ $transaction->tanggal_waktu }}</td>
                    <td>{{ $transaction->nomor_transaksi }}</td>
                    <td>{{ $transaction->no_customer }}</td>
                    <td>{{ $transaction->nama_user }}</td>
                    <td>{{ number_format($transaction->total, 2) }}</td>
                    <td><a href="{{ route('transaksi.show', ['id' => $transaction->id_transaksi]) }}" class="btn btn-info">Lihat Detail</a></td>
                </tr>

                @php $current_date = $date; @endphp
            @endforeach

            {{-- Tambahkan total pemasukan untuk tanggal terakhir --}}
            @if ($current_date != '')
                <tr>
                    <td colspan="5" class="text-end text-success"><b>Total Pemasukan:</b></td>
                    <td><b class="text-success">{{ number_format($totalPerDay[$current_date] ?? 0, 2) }}</b></td>
                    <td><a href="{{ route('admin.history.print', ['date' => $current_date]) }}" class="btn btn-primary">Cetak Data</a></td>
                </tr>
                </tbody>
                </table>
            </div>
            @endif
        </div>

        <script>
            function filterByDate() {
                var selectedDate = document.getElementById("datePicker").value;
                var tables = document.querySelectorAll("#transaction-container .table-responsive");
                tables.forEach(function(table) {
                    if (table.getAttribute("data-date") === selectedDate) {
                        table.style.display = "block";
                    } else {
                        table.style.display = "none";
                    }
                });
            }

            function previousDate() {
                var datePicker = document.getElementById("datePicker");
                var currentDate = new Date(datePicker.value);
                var previousDate = new Date(currentDate.setDate(currentDate.getDate() - 1)).toISOString().split('T')[0];
                datePicker.value = previousDate;
                filterByDate();
            }

            function nextDate() {
                var datePicker = document.getElementById("datePicker");
                var currentDate = new Date(datePicker.value);
                var nextDate = new Date(currentDate.setDate(currentDate.getDate() + 1)).toISOString().split('T')[0];
                datePicker.value = nextDate;
                filterByDate();
            }
        </script>
    </div>
@endsection
