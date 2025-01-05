<!DOCTYPE html>
<html lang="en">

<head>
    <title>Print Riwayat Transaksi - {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a {
            color: black;
        }

        @media print {

            /* Set orientation ke landscape */
            @page {
                size: landscape;
                margin: 0;
                /* Hapus margin */
            }

            body {
                margin: 0;
                /* Hapus margin di body */
                font-size: 12px;
                /* Sesuaikan ukuran teks */
            }

            .container {
                width: 100%;
                padding: 10px;
            }

            table {
                width: 100%;
            }

            th,
            td {
                border: 1px solid #000;
                padding: 8px;
                text-align: center;
            }

            .table-light {
                background-color: #f8f9fa !important;
            }

            .text-end {
                text-align: right;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="table-responsive mt-4">
            <a class="text-center" href="{{ route('history.index') }}">
                <h2>Riwayat Transaksi - {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h2>
            </a>
            <table class="table align-middle mt-3">
                <thead class="table-light">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Waktu Transaksi</th>
                        <th>Nomor Transaksi</th>
                        <th>Total Harga</th>
                        <th>Nama Kasir</th>
                        <th>Jumlah Bayar</th>
                        <th>Kembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id_transaksi }}</td>
                            <td>{{ $transaction->tanggal_waktu }}</td>
                            <td>{{ $transaction->nomor_transaksi }}</td>
                            <td>{{ number_format($transaction->total, 2) }}</td>
                            <td>{{ $transaction->nama_user }}</td>
                            <td>{{ number_format($transaction->bayar, 2) }}</td>
                            <td>{{ number_format($transaction->kembali, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class='text-end me-5'>
                <strong>Total Pemasukan: {{ number_format($totalPemasukanHarian, 2) }}</strong>
            </div>
        </div>
    </div>
</body>

</html>
