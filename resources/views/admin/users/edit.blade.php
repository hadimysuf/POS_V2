@extends('layouts.admin')

@section('content')
    <div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg"
            style="background-color: #2d3748; color: #f7fafc; border-radius: 12px; width: 100%; max-width: 600px; transition: transform 0.3s ease;">
            <div class="card-header d-flex justify-content-between align-items-center"
                style="background-color: #4a5568; color: #e2e8f0; border-radius: 12px 12px 0 0;">
                <h2 class="mb-0"><i class="fas fa-user-edit"></i> Edit User</h2>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i>
                    Back</a>
            </div>
            <div class="card-body">
                {{-- Tampilkan pesan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger" style="animation: fadeIn 0.5s;">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form untuk mengedit data user --}}
                <form action="{{ route('users.update', $user->id_user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Input Nama User --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Name</label>
                        <input type="text" name="nama_user" value="{{ old('nama_user', $user->nama_user) }}"
                            class="form-control @error('nama_user') is-invalid @enderror" placeholder="Enter user name"
                            required>
                        @error('nama_user')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Username --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-envelope"></i> Username/Email</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}"
                            class="form-control @error('username') is-invalid @enderror"
                            placeholder="Enter email or username" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" value="{{ old('password', $user->password) }}"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Enter password"
                            required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pilihan Role --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user-tag"></i> Role</label>
                        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
                            <option value="1" {{ old('role_id', $user->role_id) == 1 ? 'selected' : '' }}>Admin
                            </option>
                            <option value="2" {{ old('role_id', $user->role_id) == 2 ? 'selected' : '' }}>Kasir
                            </option>
                            <option value="3" {{ old('role_id', $user->role_id) == 3 ? 'selected' : '' }}>Gudang
                            </option>
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input Nomor Handphone --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-phone"></i> Phone</label>
                        <input type="text" name="nomor_handphone"
                            value="{{ old('nomor_handphone', $user->nomor_handphone) }}"
                            class="form-control @error('nomor_handphone') is-invalid @enderror"
                            placeholder="Enter phone number" required>
                        @error('nomor_handphone')
                            <div class="invalid-feedback">Must be 8-12 digits and start with (+62).</div>
                        @enderror
                    </div>

                    {{-- Input Alamat --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Address</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Enter address"
                            required>{{ old('alamat', $user->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">Must start with "Jl."</div>
                        @enderror
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg w-100"
                            style="background-color: #4fd1c5; border: none; color: #2d3748; animation: pulse 1.5s infinite;">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SweetAlert untuk notifikasi sukses --}}
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '<i class="fas fa-check-circle"></i> Success!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4fd1c5',
                    background: '#2d3748',
                    color: '#f7fafc',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('users.index') }}";
                    }
                });
            });
        </script>
    @endif

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.01);
            }
        }
    </style>
@endsection
