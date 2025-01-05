@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit User</h2>

        {{-- Tampilkan pesan error validasi --}}
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Form untuk mengedit data user --}}
        <form action="{{ route('users.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Input Nama User --}}
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}"
                    class="form-control @error('nama_user') is-invalid @enderror" required>
                @error('nama_user')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Username --}}
            <div class="form-group">
                <label>Username/Email</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}"
                    class="form-control @error('username') is-invalid @enderror" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" value="{{ old('password', $user->password) }}"
                    class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Pilihan Role --}}
            <div class="form-group">
                <label>Role</label>
                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                    <option value="1" {{ old('role_id', $user->role_id) == 1 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('role_id', $user->role_id) == 2 ? 'selected' : '' }}>Kasir</option>
                    <option value="3" {{ old('role_id', $user->role_id) == 3 ? 'selected' : '' }}>Gudang</option>
                </select>
                @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Nomor Handphone --}}
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="nomor_handphone" value="{{ old('nomor_handphone', $user->nomor_handphone) }}"
                    class="form-control @error('nomor_handphone') is-invalid @enderror" required>
                @error('nomor_handphone')
                    <div class="invalid-feedback">*Harus 8-12 digits diawali dengan (+62)</div>
                @enderror
            </div>

            {{-- Input Alamat --}}
            <div class="form-group">
                <label>Address</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                    required>{{ old('alamat', $user->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">*Harus diawali dengan "Jl."</div>
                @enderror
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    {{-- SweetAlert untuk notifikasi sukses --}}
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
