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
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari pengguna berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Cek apakah pengguna ditemukan dan password cocok
        if ($user && $user->password === $request->password) {
            // Simpan data pengguna ke session
            session([
                'username' => $user->username,
                'role' => $user->role_id === 1 ? 'admin' : 'kasir', // Role berdasarkan role_id
            ]);

            // Redirect sesuai dengan role
            if ($user->role_id === 1) {
                return redirect('/admin/dashboard')->with('success', 'Login sebagai Admin berhasil!');
            } else {
                return redirect('/kasir/dashboard')->with('success', 'Login sebagai Kasir berhasil!');
            }
        }

        return back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Logout berhasil!');

        // // Setelah menyimpan session
        // dd(session('username'), session('role'));
    }
}
