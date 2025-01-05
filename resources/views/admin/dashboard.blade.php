@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, {{ $username }}!</p>

        <div class="row">
            <!-- Total Pengguna -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengguna</h5>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Produk -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                        <p class="card-text">{{ $totalProducts }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Transaksi -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi</h5>
                        <p class="card-text">{{ $totalTransactions }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Total Transaksi dan Pemasukan -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h3>Grafik Bulan Pemasukan</h3>
                <canvas id="monthlyTransactionsChart"></canvas>
            </div>
        </div>
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
            const totalTransactions = data.map(item => item.total_transactions);
            const totalIncome = data.map(item => item.total_income);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Label sumbu X (bulan)
                    datasets: [
                        {
                            label: 'Total Transaksi',
                            data: totalTransactions,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Total Pemasukan',
                            data: totalIncome,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true },
                        tooltip: { 
                            mode: 'index', 
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw || 0;
                                    return context.dataset.label + ': Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: { title: { display: true, text: 'Bulan' } },
                        y: { 
                            title: { display: true, text: 'Jumlah' },
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Ambil data dari server
        fetch('{{ route("admin.monthly.stats") }}')
            .then(response => response.json())
            .then(data => {
                drawChart(data);
            })
            .catch(error => console.error('Error fetching monthly stats:', error));
    </script>
@endsection
