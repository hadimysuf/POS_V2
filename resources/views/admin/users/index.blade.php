@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Users</h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama User</th>
                    <th>Username/Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Nomor Handphone</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id_user }}</td>
                        <td>{{ $user->nama_user }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->password }}</td>
                        <td>
                            {{ match ($user->role_id) {
                                1 => 'Admin',
                                2 => 'Kasir',
                                default => 'Gudang',
                            } }}
                        </td>
                        <td>{{ $user->nomor_handphone }}</td>
                        <td>{{ $user->alamat }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('users.destroy', $user->id_user) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#00c6fb',
                    background: '#1e2832',
                    color: '#ffffff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('users.index') }}";
                    }
                });
            });
        </script>
    @endif
@endsection
