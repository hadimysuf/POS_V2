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
use App\Http\Controllers\TransactionHistoryController;

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

// Produk Routes
Route::resource('produk', ProductController::class);

// Default Route
Route::get('/', function () {
    return view('index');
});
