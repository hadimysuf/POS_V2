<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|email', // Validasi menggunakan email
            'password' => 'required',    // Validasi password
        ]);

        // Cari pengguna berdasarkan email
        $user = User::where('username', $request->username)->first();

        // Cek apakah pengguna ditemukan dan password cocok
        if ($user && $user->password === $request->password) {
            // Set session sesuai role
            session([
                'username' => $user->username,
                'role' => $user->role_id === 1 ? 'admin' : ($user->role_id === 2 ? 'kasir' : 'pergudangan'),
            ]);

            // Redirect ke halaman sesuai role
            if ($user->role_id === 1) {
                return redirect('/admin/dashboard')->with('success', 'Login sebagai Admin berhasil!');
            } elseif ($user->role_id === 2) {
                return redirect('/kasir/dashboard')->with('success', 'Login sebagai Kasir berhasil!');
            } elseif ($user->role_id === 3) {
                return redirect('/gudang/dashboard')->with('success', 'Login sebagai Admin Gudang berhasil!');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
