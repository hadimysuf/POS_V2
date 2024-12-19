<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KasirDashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionHistoryController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('admin')
    ->name('admin.dashboard');

// Rute kasir
Route::get('/kasir/dashboard', [KasirDashboardController::class, 'index'])
    ->middleware('kasir')
    ->name('kasir.dashboard');

Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/history', [TransactionHistoryController::class, 'index'])->name('history.index');

// Route::get('/', [IndexController::class, 'index'])->middleware('AdminCheck');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
