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
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|unique:user_pengguna,username|max:255',
            'password' => 'required|string|min:8',
            'role_id' => 'required|integer',
            'nomor_handphone' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        User::create([
            'nama_user' => $request->nama_user,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'nomor_handphone' => $request->nomor_handphone,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
            'role_id' => 'required|integer',
            'nomor_handphone' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
