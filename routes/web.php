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
    Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/history', [TransactionHistoryController::class, 'index'])->name('history.index');
});

// Kasir Routes
Route::middleware('kasir')->group(function () {
    Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])->name('kasir.dashboard');
    Route::post('/kasir/add-to-cart', [KasirDashboardController::class, 'addToCart'])->name('kasir.addToCart');
    Route::post('/kasir/reset-cart', [KasirDashboardController::class, 'resetCart'])->name('kasir.resetCart');
    Route::get('/kasir/print-receipt/{id}', [KasirDashboardController::class, 'printReceipt'])->name('kasir.printReceipt');
    Route::post('/kasir/checkout', [KasirDashboardController::class, 'checkout'])->name('kasir.checkout');
});

// User Routes
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index'); // Read
    Route::get('/create', [UserController::class, 'create'])->name('users.create'); // Form Create
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
    Route::get('/gudang/notifikasi', [GudangDashboardController::class, 'notifikasi'])->name('gudang.notifikasi');
    Route::resource('pergudangan', PergudanganController::class);
});




// Produk Routes
Route::resource('produk', ProductController::class);
Route::get('/admin/products/create', [AdminDashboardController::class, 'create'])->name('admin.products.create');



// Default Route
Route::get('/', function () {
    return view('index');
});
