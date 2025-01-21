<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function regis()
    {
        $roles = Role::all();
        return view('register', compact('roles'));
    }
    public function register(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_user' => 'required|string|max:100',
            'username' => 'required|email|unique:users,username',
            'password' => 'required|string|min:6',
            'nomor_handphone' => 'required|string|regex:/^\+62[0-9]{8,12}$/',
            'alamat' => 'required|string|regex:/^Jl\..*/',
        ]);

        // Simpan data ke tabel users
        User::create([
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'password' => $request->password,
            'role_id' => $request->role_id,
            'nomor_handphone' => $request->nomor_handphone,
            'alamat' => $request->alamat,
        ]);
        // User::create([
        //     'nama_user' => $request->nama_user,
        //     'username' => $request->username,
        //     'password' => $request->password,
        //     'role_id' => 2,
        //     'nomor_handphone' => $request->nomor_handphone,
        //     'alamat' => $request->alamat,
        // ]);

        return redirect()->route('login')->with('success', 'User berhasil didaftarkan!, silahkan login kembali');
    }
}
