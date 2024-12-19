<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // Ambil data dari session
        $username = session('username'); // Ambil nilai 'username' dari session

        // Periksa apakah session 'username' tersedia
        if (!$username) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Kirim variabel ke view
        return view('index', compact('username'));
    }
}
