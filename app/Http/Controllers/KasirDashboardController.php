<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $username = session('username');
        $role = session('role'); // Ambil role dari session

        // Periksa apakah pengguna adalah kasir
        if ($role !== 'kasir') {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        return view('kasir.dashboard', compact('username', 'role'));
    }
}
