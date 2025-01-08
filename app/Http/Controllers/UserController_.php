<?
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController_ extends Controller
{
    // Menampilkan semua data pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('admin.users.create');
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_pengguna',
            'password' => 'required|string|min:6',
            'role_id' => 'required|integer',
            'nomor_handphone' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $validated['password'] = bcrypt($validated['password']); // Enkripsi password
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Menampilkan form edit data pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_pengguna,username,' . $id,
            'role_id' => 'required|integer',
            'nomor_handphone' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Menghapus data pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}