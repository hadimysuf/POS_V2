<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja</title>
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

        .btn-container {
            margin-top: 20px;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            font-size: 14px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .btn-print {
            background-color: #4CAF50;
            color: white;
        }

        .btn-back {
            background-color: #008CBA;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Tombol Aksi -->
    <div class="btn-container">
        <button class="btn btn-print" onclick="window.print()">Print Struk</button>
        <a href="{{ route('kasir.dashboard') }}" class="btn btn-back">Kembali ke Dashboard</a>
    </div>

    <!-- Desain Struk -->
    <div class="receipt-container">
        <!-- Judul Toko -->
        <h2>LocalFood Resto</h2>
        <p>Jl. Belanja No. 10, Bandung</p>
        <p>Telp: 0812-3456-7890</p>

        <!-- Detail Transaksi -->
        <div class="line"></div>
        <p><strong>Nomor Transaksi:</strong> {{ $transaksi->nomor_transaksi }}</p>
        <p><strong>Tanggal:</strong> {{ $transaksi->tanggal_waktu }}</p>
        <p><strong>Karyawan:</strong> {{ $transaksi->nama_user }}</p>
        <div class="line"></div>

        <!-- Detail Produk -->
        <table class="table">
            <thead>
                <tr>
                    <td class="bold">Produk</td>
                    <td class="bold center">Jumlah</td>
                    <td class="bold right">Harga</td>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->details as $item)
                    <tr>
                        <td>{{ $item->produk->nama_produk }}</td>
                        <td class="center">{{ $item->jumlah }}</td>
                        <td class="right">{{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total -->
        <div class="line"></div>
        <table class="table">
            <tr>
                <td class="bold">Total</td>
                <td class="right">{{ number_format($transaksi->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bold">Bayar</td>
                <td class="right">{{ number_format($transaksi->bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="bold">Kembali</td>
                <td class="right">{{ number_format($transaksi->kembali, 0, ',', '.') }}</td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="line"></div>
        <p class="footer">*** Terima Kasih ***</p>
        <p class="footer">Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan</p>
    </div>
</body>
</html>
