<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 80%;
            max-width: 1200px;
            margin: 20px;
        }

        .card-header h5 {
            font-weight: bold;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        td,
        th {
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
        }

        .btn-outline-secondary {
            border: 1px solid #ddd;
            padding: 10px 20px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="card mb-4">
            <div class="card-header text-center">
                <a style="color: black;" href="{{ route('history.index') }}">
                    <h5>Laporan Transaksi Bulan {{ \Carbon\Carbon::parse("$year-$month-01")->format('F Y') }}</h5>
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Waktu</th>
                            <th>No. Transaksi</th>
                            <th>No. Customer</th>
                            <th>Kasir</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr onclick="window.location.href='{{ route('history.index') }}'">
                                <td>{{ $transaction->id_transaksi }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->tanggal_waktu)->format('H:i') }}</td>
                                <td>{{ $transaction->nomor_transaksi }}</td>
                                <td>{{ $transaction->no_customer }}</td>
                                <td>{{ $transaction->nama_user }}</td>
                                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total Pemasukan:</strong></td>
                            <td><strong>Rp {{ number_format($totalPemasukanBulanan, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="text-center">
                    <button class="btn btn-outline-secondary" onclick="window.print()">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
