<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .receipt-container {
            width: 300px;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2, h4, p {
            text-align: center;
            margin: 0;
            padding: 5px 0;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td {
            padding: 5px;
            font-size: 14px;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <h2>Point of Sales</h2>
        <p>Jl. Example No. 123, Kota</p>
        <p>Telp: 0812-3456-7890</p>
        <div class="line"></div>

        <p><strong>Nomor Transaksi:</strong> {{ $transaction->nomor_transaksi }}</p>
        <p><strong>Tanggal:</strong> {{ $transaction->tanggal_waktu }}</p>
        <p><strong>Nama Kasir:</strong> {{ $transaction->nama_user }}</p>
        <div class="line"></div>

        <table class="table">
            <thead>
                <tr>
                    <td class="bold">Produk</td>
                    <td class="bold center">Jumlah</td>
                    <td class="bold right">Harga</td>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->details as $item)
                    <tr>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td class="center">{{ $item->jumlah }}</td>
                        <td class="right">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="line"></div>
        <table class="table">
            <tr>
                <td class="bold">Total</td>
                <td class="right">Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bold">Bayar</td>
                <td class="right">Rp {{ number_format($transaction->bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bold">Kembali</td>
                <td class="right">Rp {{ number_format($transaction->kembali, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="line"></div>
        <p class="footer">*** Terima Kasih ***</p>
        <p class="footer">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan.</p>
    </div>
</body>
</html>
