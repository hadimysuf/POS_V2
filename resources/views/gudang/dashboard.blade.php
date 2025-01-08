@extends('layouts.gudang')

@section('content')
    <div class="container">
        <h1>Dashboard Admin Gudang</h1>
        <p>Selamat datang, {{ session('username') }}!</p>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text">{{ $totalProduk }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi Masuk</h5>
                        <p class="card-text">{{ $totalTransaksiMasuk }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h3>Menu</h3>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('gudang.produk') }}" class="btn btn-primary btn-block">Daftar Produk</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('gudang.produk.masuk') }}" class="btn btn-secondary btn-block">Input Barang Masuk</a>
            </div>
        </div>

        <h3 class="mt-4">Produk dengan Stok Rendah</h3>
        @if ($stokRendah->isEmpty())
            <p>Tidak ada produk dengan stok rendah.</p>
        @else
            <table class="table table-bordered text-white">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Stok Minimum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stokRendah as $produk)
                        <tr>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>{{ $produk->stok_minimum }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <canvas id="monthlyTransactionsChart" width="400" height="200"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Array untuk nama-nama bulan
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Fungsi untuk menggambar grafik
        function drawChart(data) {
            const ctx = document.getElementById('monthlyTransactionsChart').getContext('2d');

            // Ubah data menjadi array untuk grafik
            const labels = data.map(item => monthNames[item.month - 1] + ' ' + item.year);
            const totals = data.map(item => item.transaction_count);

            new Chart(ctx, {
                type: 'bar', // Mengubah tipe chart menjadi bar
                data: {
                    labels: labels, // Label sumbu X (bulan)
                    datasets: [{
                        label: 'Jumlah Transaksi Masuk',
                        data: totals,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    return context.dataset.label + ': ' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Jumlah Transaksi'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Ambil data dari server
        fetch("{{ route('gudang.transactions.monthly') }}")
            .then(response => response.json())
            .then(data => {
                drawChart(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    </script>
@endsection
