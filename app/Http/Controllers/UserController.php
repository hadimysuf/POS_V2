<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Ambil data pengguna dari database
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string|max:100',
            'username' => 'required|email|unique:user_pengguna,username',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:role,id_role',
            'nomor_handphone' => 'required|string|regex:/^\+62[0-9]{8,12}$/',
            'alamat' => 'required|string|regex:/^Jl\..*/',
        ]);

        User::create([
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'nomor_handphone' => $request->nomor_handphone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('users.create')->with('success', 'User created successfully.');
    }
    public function edit($id_user)
    {
        $user = User::findOrFail($id_user);
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id_user)
    {
        $user = User::findOrFail($id_user);

        $request->validate([
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_pengguna,username,' . $id_user . ',id_user',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:role,id_role',
            'nomor_handphone' => 'required|string|regex:/^\+62[0-9]{8,12}$/',
            'alamat' => 'required|string|regex:/^Jl\..*/',
        ]);

        $user->update($request->all());

        return redirect()->route('users.edit')->with('success', 'User updated successfully.');
    }
    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
