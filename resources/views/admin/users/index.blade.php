@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Manage Users</h2>
        <table class="table text-light">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id_user }}</td>
                        <td>{{ $user->nama_user }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->role_id === 1 ? 'Admin' : 'Kasir' }}</td>
                        <td>{{ $user->nomor_handphone }}</td>
                        <td>{{ $user->alamat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
