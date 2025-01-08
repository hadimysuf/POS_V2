@extends('layouts.app')

@section('content')
    <style>
        .pos-container {
            background: rgba(30, 40, 50, 0.6);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-title {
            color: #fff;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            background: linear-gradient(45deg, #00c6fb, #005bea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .product-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 0.5rem;
        }

        .quantity-control {
            background: rgba(255, 255, 255, 0.05);
            border: none;
            color: #fff;
            width: 80px !important;
            text-align: center;
        }

        .cart-table {
            background: rgba(30, 40, 50, 0.4);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .cart-table th {
            background: rgba(0, 198, 251, 0.1);
            color: #fff;
            font-weight: 600;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .cart-table td {
            color: #fff;
            border-color: rgba(255, 255, 255, 0.1);
            vertical-align: middle;
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }

        .total-section {
            background: linear-gradient(145deg, rgba(0, 198, 251, 0.1), rgba(0, 91, 234, 0.1));
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin: 2rem 0;
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: 600;
            color: #00c6fb;
        }

        .checkout-form {
            background: rgba(30, 40, 50, 0.4);
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        input[type="number"],
        input[type="text"],
        select {
            color: white;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .btn-gradient {
            background: linear-gradient(45deg, #00c6fb, #005bea);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 198, 251, 0.3);
        }
    </style>

    <div class="container">
        <div class="pos-container">
            <h1 class="section-title">Point of Sales</h1>

            <!-- Product Selection Form -->
            <form action="{{ route('kasir.addToCart') }}" method="POST" class="mb-4">
                @csrf
                <div class="input-group">
                    <select name="id_produk" class="form-control product-select" required>
                        <option class="text-dark" value="">Pilih Produk</option>
                        @foreach ($produk as $p)
                            <option class="text-dark" value="{{ $p->id_produk }}">{{ $p->nama_produk }} - Rp
                                {{ number_format($p->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah" class="form-control quantity-control" placeholder="Jumlah" required
                        min="1">
                    <button type="submit" class="btn btn-gradient">Tambah ke Keranjang</button>
                </div>
            </form>

            <!-- Shopping Cart -->
            <h2 class="section-title">Keranjang Belanja</h2>
            <form action="{{ route('kasir.updateCart') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @if (session('cart'))
                                @foreach (session('cart') as $id => $item)
                                    <tr>
                                        <td>{{ $item['nama_produk'] }}</td>
                                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                        <td>
                                            <div class="quantity-wrapper">
                                                <button type="button" class="btn btn-warning quantity-btn"
                                                    onclick="updateQuantity({{ $id }}, -1)">-</button>
                                                <input type="number" name="cart[{{ $id }}][jumlah]"
                                                    value="{{ $item['jumlah'] }}" min="1"
                                                    class="form-control quantity-control">
                                                <button type="button" class="btn btn-success quantity-btn"
                                                    onclick="updateQuantity({{ $id }}, 1)">+</button>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('kasir.removeFromCart', $id) }}"
                                                class="btn btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                <i class="fas fa-trash">hapus</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php $total += $item['harga'] * $item['jumlah']; @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Keranjang kosong</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="action-buttons">
                    <button type="submit" class="btn btn-gradient">Update Keranjang</button>
                    <button type="button" class="btn btn-danger" onclick="resetCart()">Reset Keranjang</button>
                </div>
            </form>

            <!-- Checkout Section -->
            <div class="total-section">
                <h3 class="total-amount">Total: Rp {{ number_format($total, 0, ',', '.') }}</h3>
            </div>

            <div class="checkout-form">
                <form action="{{ route('kasir.checkout') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                            <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bayar" class="form-label">Jumlah Pembayaran</label>
                            <input type="number" name="bayar" id="bayar" class="form-control" required
                                min="{{ $total }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient btn-lg w-100">Proses Pembayaran</button>
                </form>
            </div>

            <div class="action-buttons">
                <a href="{{ route('kasir.history') }}" class="btn btn-gradient">
                    <i class="fas fa-history"></i> Riwayat Transaksi
                </a>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(id, delta) {
            let input = document.querySelector(`input[name="cart[${id}][jumlah]"]`);
            let newValue = parseInt(input.value) + delta;
            if (newValue >= 1) {
                input.value = newValue;
            }
        }

        function resetCart() {
            Swal.fire({
                title: 'Konfirmasi Reset',
                text: 'Apakah Anda yakin ingin mengosongkan keranjang?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00c6fb',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset',
                cancelButtonText: 'Batal',
                background: '#1e2832',
                color: '#ffffff'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ route('kasir.resetCart') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#00c6fb',
                    background: '#1e2832',
                    color: '#ffffff'
                });
            });
        </script>
    @endif

@endsection
