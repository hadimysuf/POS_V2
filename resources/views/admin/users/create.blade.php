@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Create User</h2>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="nama_user" class="form-control @error('nama_user') is-invalid @enderror" required>
                @error('nama_user')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Username/Email</label>
                <input type="email" name="username" class="form-control @error('username') is-invalid @enderror" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                    <option value="1">Admin</option>
                    <option value="2">Kasir</option>
                </select>
                @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="nomor_handphone"
                    class="form-control @error('nomor_handphone') is-invalid @enderror" required>
                @error('nomor_handphone')
                    <div class="invalid-feedback">*Harus 8-12 digits diawali dengan (+62)</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required></textarea>
                @error('alamat')
                    <div class="invalid-feedback">*Harus diawali dengan "Jl."</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
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
