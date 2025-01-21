<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .group-header {
            font-weight: bold;
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penjualan</h1>
        <p>Periode: {{ $startDate }} - {{ $endDate }}</p>
    </div>

    @foreach ($groupedData as $namaProduk => $details)
        <h3>{{ $namaProduk }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Tanggal Penjualan</th>
                    <th>Total Per Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->tanggal_penjualan }}</td>
                        <td>{{ $detail->total_per_tanggal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
