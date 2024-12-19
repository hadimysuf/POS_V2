<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionHistoryController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dari database
        $transactions = Transaction::all();

        return view('admin.history.index', compact('transactions'));
    }
}
