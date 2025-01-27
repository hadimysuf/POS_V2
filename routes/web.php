<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KasirDashboardController;
use App\Http\Controllers\GudangDashboardController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\PergudanganController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\TransaksiHistoryAdmin;
use App\Http\Controllers\DataPenjualanController;

// Login Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Register Routes
Route::get('/register', [RegisterController::class, 'regis'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Admin Routes
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/monthly-stats', [AdminDashboardController::class, 'getMonthlyStats'])->name('admin.monthly.stats');
    Route::get('/admin/sales/create', [SalesController::class, 'create'])->name('sales.create');
    Route::get('/admin/produk', [ProductController::class, 'index'])->name('products.index');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create'); // Form Create
    Route::get('/admin/history', [TransaksiHistoryAdmin::class, 'index'])->name('history.index');
    Route::get('/admin/history/filter/{date}', [TransaksiHistoryAdmin::class, 'filterByDate']);
    Route::get('/admin/history-{id}', [TransaksiHistoryAdmin::class, 'show'])->name('transaksi.show');
    Route::get('/admin/history/print-{date}', [TransaksiHistoryAdmin::class, 'print'])->name('admin.history.print');
    Route::get('admin/history/printByMonthYearWebp/{month}/{year}', [TransaksiHistoryAdmin::class, 'printByMonthYear'])->name('admin.history.printMonth');
    Route::get('/admin/data-penjualan', [AdminDashboardController::class, 'dataPenjualan'])->name('admin.dataPenjualan');
    Route::get('/admin/data-penjualan', [DataPenjualanController::class, 'index'])->name('admin.dataPenjualan');
    Route::get('/admin/data_penjualan', [DataPenjualanController::class, 'index'])->name('data_penjualan');
    Route::get('/admin/data_penjualan/filter', [DataPenjualanController::class, 'filter'])->name('data_penjualan.filter');
    Route::get('/data-penjualan/cetak', [DataPenjualanController::class, 'cetak'])->name('data-penjualan.cetak');
    Route::get('/data-penjualan', [DataPenjualanController::class, 'index'])->name('data.penjualan');
    Route::get('/data-penjualan/filter', [DataPenjualanController::class, 'filter'])->name('data-penjualan.filter');
    Route::get('/data-penjualan', [DataPenjualanController::class, 'index'])->name('data_penjualan.index');
    Route::get('/data-penjualan/filter', [DataPenjualanController::class, 'filter'])->name('data_penjualan.filter');
    Route::get('/data-penjualan/cetak', [DataPenjualanController::class, 'cetak'])->name('data_penjualan.cetak');
});


// Kasir Routes
Route::middleware('kasir')->group(function () {
    Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])->name('kasir.dashboard');
    Route::post('/kasir/add-to-cart', [KasirDashboardController::class, 'addToCart'])->name('kasir.addToCart');
    Route::get('/remove-from-cart/{id}', [KasirDashboardController::class, 'removeFromCart'])->name('kasir.removeFromCart');
    Route::post('/update-cart', [KasirDashboardController::class, 'updateCart'])->name('kasir.updateCart');
    Route::post('/kasir/reset-cart', [KasirDashboardController::class, 'resetCart'])->name('kasir.resetCart');
    Route::get('/kasir/print-receipt/{id}', [KasirDashboardController::class, 'printReceipt'])->name('kasir.printReceipt');
    Route::post('/kasir/checkout', [KasirDashboardController::class, 'checkout'])->name('kasir.checkout');
    Route::get('/kasir/transactions', [TransactionHistoryController::class, 'index'])->name('kasir.transactions');
    Route::get('/kasir/transactions/{id}', [TransactionHistoryController::class, 'show'])->name('kasir.transactions.show');
    Route::get('/kasir/history', [TransactionHistoryController::class, 'index'])->name('kasir.history.index');
    Route::get('/kasir/history/{id}', [TransactionHistoryController::class, 'show'])->name('kasir.history.show');
    Route::get('/kasir/history', [TransactionHistoryController::class, 'index'])->name('kasir.history');
    Route::get('/kasir/history/{id}/receipt', [TransactionHistoryController::class, 'showReceipt'])->name('kasir.history.receipt');
    Route::get('/history', [TransactionHistoryController::class, 'index'])->name('kasir.history.index');
    Route::get('/history/{id}', [TransactionHistoryController::class, 'show'])->name('kasir.history.show');
    Route::get('/history/{id}/receipt', [TransactionHistoryController::class, 'showReceipt'])->name('kasir.history.receipt');
    Route::get('/{id_transaksi}/create', [ReturController::class, 'create'])->name('retur.create'); // Form proses retur
    Route::post('/store', [ReturController::class, 'store'])->name('retur.store'); // Proses penyimpanan retur

});


// User Routes
Route::prefix('/admin/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index'); // Read

    Route::post('/', [UserController::class, 'store'])->name('users.store'); // Create
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit'); // Form Edit
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update'); // Update
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete
});

// Gudang Routes
Route::middleware('gudang')->group(function () {
    Route::get('/gudang/dashboard', [GudangDashboardController::class, 'index'])->name('gudang.dashboard');
    Route::get('/gudang/produk', [GudangDashboardController::class, 'produk'])->name('gudang.produk');
    Route::get('/gudang/transaksi/masuk', [GudangDashboardController::class, 'transaksiMasuk'])->name('gudang.transaksi.masuk');
    Route::post('/gudang/transaksi/masuk', [GudangDashboardController::class, 'simpanTransaksiMasuk'])->name('gudang.transaksi.simpanMasuk');
    Route::get('/gudang/notifikasi', [GudangDashboardController::class, 'notifikasiStokRendah'])->name('gudang.notifikasi');
    Route::get('/gudang/produk/masuk', [GudangDashboardController::class, 'create'])->name('gudang.produk.masuk');
    Route::post('/gudang/produk/masuk', [GudangDashboardController::class, 'store'])->name('gudang.produk.store');
    Route::get('/gudang/dashboard', [GudangDashboardController::class, 'index'])->name('gudang.dashboard');

    // Rute untuk menampilkan halaman input barang masuk
    Route::get('/gudang/masuk', [GudangDashboardController::class, 'showBarangMasuk'])->name('gudang.masuk');
    //rute grafik bulanan
    Route::get('/gudang/transactions/monthly', [GudangDashboardController::class, 'getMonthlyTransactions'])->name('gudang.transactions.monthly');

    // Rute untuk menyimpan barang masuk
    Route::post('/gudang/masuk', [GudangDashboardController::class, 'storeBarangMasuk'])->name('gudang.masuk.store');
    Route::get('/gudang/notifikasi/stok-rendah', [GudangDashboardController::class, 'notifikasiStokRendah'])->name('gudang.notifikasi.stokRendah');

    //Menampilkan transaksi masuk
    Route::get('/gudang/transaksi', [GudangDashboardController::class, 'daftarTransaksi'])->name('gudang.transaksi');

    //tambah stok
    Route::get('/pergudangan', [GudangDashboardController::class, 'create'])->name('gudang.tambah_stok');
    Route::post('/pergudangan', [GudangDashboardController::class, 'store'])->name('gudang.tambah_stok');

    //tambah produk baru
    Route::prefix('pergudangan/produk')->name('gudang.produk.')->group(function () {
        Route::get('/', [PergudanganController::class, 'index'])->name('index'); // Menampilkan daftar produk
        Route::get('/create', [PergudanganController::class, 'create'])->name('create'); // Form tambah produk
        Route::post('/', [PergudanganController::class, 'store'])->name('store'); // Simpan produk baru
        Route::get('/{id}/edit', [PergudanganController::class, 'edit'])->name('edit'); // Form edit produk
        Route::put('/{id}', [PergudanganController::class, 'update'])->name('update'); // Update produk
        Route::delete('/{produk}', [PergudanganController::class, 'destroy'])->name('destroy'); // Hapus produk
    });
});



// web.php


// Produk Routes
Route::resource('admin/produk', ProductController::class);
Route::get('/admin/produk/create', [ProductController::class, 'create'])->name('admin.products.create');



// Default Route
Route::get('/', function () {
    return view('index');
});
