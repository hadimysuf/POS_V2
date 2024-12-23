@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center py-5">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card border-0 shadow-xl">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-5">
                            <h2 class="display-4 fw-bold mb-3"
                                style="background: #00c6fb; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                Buat Akun Anda</h2>
                            <p class="text-muted lead" style="color: rgba(255, 255, 255, 0.7) !important">Silahkan Masukan
                                Data User Baru</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm rounded-3"
                                style="background: rgba(220, 53, 69, 0.1); border: 1px solid rgba(220, 53, 69, 0.2);">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" class="needs-validation">
                            @csrf
                            <div class="row g-4">
                                <!-- Name Field -->
                                <div class="col-12">
                                    <div class="form-floating mb-4">
                                        <input type="text" name="nama_user"
                                            class="form-control form-control-lg @error('nama_user') is-invalid @enderror"
                                            id="nama_user" value="{{ old('nama_user') }}" required placeholder="Nama User">
                                        <label class="text-muted">
                                            <i class="fa-solid fa-user me-2"></i>Nama User
                                        </label>
                                        @error('nama_user')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Username & Password -->
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" name="username"
                                            class="form-control form-control-lg @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" required placeholder="Username">
                                        <label class="text-muted">
                                            <i class="fa-solid fa-at me-2"></i>Username
                                        </label>
                                        @error('username')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="password" name="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            required placeholder="Password">
                                        <label class="text-muted">
                                            <i class="fa-solid fa-lock me-2"></i>Password
                                        </label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Role Selection -->
                                <div class="col-12">
                                    <div class="form-floating mb-4">
                                        <select class="form-select form-control-lg @error('role_id') is-invalid @enderror"
                                            id="role_id" name="role_id" required>
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id_role }}"
                                                    {{ old('role_id') == $role->id_role ? 'selected' : '' }}>
                                                    {{ $role->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="text-muted">
                                            <i class=" me-2"></i>Role
                                        </label>
                                        @error('role_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone Number -->
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="tel" name="nomor_handphone"
                                            class="form-control form-control-lg @error('nomor_handphone') is-invalid @enderror"
                                            value="{{ old('nomor_handphone') }}" required placeholder="(+62)8">
                                        <label class="text-muted">
                                            <i class="fa-solid fa-phone me-2"></i>Phone Number
                                        </label>
                                        @error('nomor_handphone')
                                            <div class="invalid-feedback">*Harus 8-12 digits diawali dengan(+62)</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" name="alamat"
                                            class="form-control form-control-lg @error('alamat') is-invalid @enderror"
                                            value="{{ old('alamat') }}" required placeholder="Jl.">
                                        <label class="text-muted">
                                            <i class="fa-solid fa-location-dot me-2"></i>Alamat
                                        </label>
                                        @error('alamat')
                                            <div class="invalid-feedback">*Harus diawali dengan "Jl."</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-4 fw-bold">
                                        <i class="fa-solid fa-user-plus me-2"></i>Register
                                    </button>
                                    <div class="text-center">
                                        <p class="text-muted mb-0" style="color: rgba(255, 255, 255, 0.7) !important">
                                            Sudah Punya akun?
                                            <a href="{{ route('login') }}"
                                                class="text-decoration-none fw-bold gradient-text">
                                                Masuk
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            border-radius: 0.5rem;
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #00c6fb !important;
            box-shadow: 0 0 15px rgba(0, 198, 251, 0.2) !important;
        }

        .form-floating>label {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label,
        .form-floating>.form-select:focus~label {
            color: #00c6fb !important;
            transform: scale(0.85) translateY(-0.75rem) translateX(0.15rem);
        }

        .btn-primary {
            background: linear-gradient(45deg, #00c6fb, #005bea) !important;
            border: none !important;
            height: 3.5rem;
            border-radius: 0.75rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 198, 251, 0.3);
        }

        .gradient-text {
            background: linear-gradient(45deg, #00c6fb, #005bea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card {
            background: linear-gradient(145deg, #314b66, #2a3744);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.1) !important;
            border: 1px solid rgba(220, 53, 69, 0.2) !important;
            color: #ff6b6b !important;
        }

        select option {
            background-color: #2a3744;
            color: #ffffff;
        }

        .invalid-feedback {
            color: #ff6b6b !important;
        }
    </style>

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
                });
            });
        </script>
    @endif
@endsection
