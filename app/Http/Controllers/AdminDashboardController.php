<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $username = session('username');
        $role = session('role');

        if ($role !== 'admin') {
            return redirect('/login')->with('error', 'Unauthorized access.');
        }

        return view('admin.dashboard', compact('username', 'role'));
    }
}
