@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create User</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="nama_user" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role_id" class="form-control">
                <option value="1">Admin</option>
                <option value="2">Kasir</option>
            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="nomor_handphone" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
