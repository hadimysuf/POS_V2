@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form action="{{ route('users.update', $user->id_user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="nama_user" value="{{ $user->nama_user }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ $user->username }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role_id" class="form-control">
                <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Kasir</option>
            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="nomor_handphone" value="{{ $user->nomor_handphone }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="alamat" class="form-control" required>{{ $user->alamat }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
