@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center py-5">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-xl">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-5">
                            <h2 class="display-4 fw-bold mb-3"
                                style="background:  #00c6fb; -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                Point Of Sales</h2>
                            <p class="text-muted lead" style="color: rgba(255, 255, 255, 0.7) !important">Masuk ke Akun Anda
                            </p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger border-0 shadow-sm rounded-3"
                                style="background: rgba(220, 53, 69, 0.1); border: 1px solid rgba(220, 53, 69, 0.2);">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="needs-validation">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-floating mb-4">
                                <input type="email"
                                    class="form-control form-control-lg @error('username') is-invalid @enderror"
                                    id="email" name="username" placeholder="name@example.com" required autofocus>
                                <label for="email" class="text-muted">
                                    <i class="bi bi-envelope me-2"></i>Email Address
                                </label>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-floating mb-4">
                                <input type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password" required>
                                <label for="password" class="text-muted">
                                    <i class="bi bi-lock me-2"></i>Password
                                </label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4 fw-bold">
                                Sign In
                            </button>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="text-muted mb-0" style="color: rgba(255, 255, 255, 0.7) !important">
                                    Belum Punya akun?
                                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold gradient-text">
                                        Daftar
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            border-radius: 0.5rem;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08) !important;
            border-color: #00c6fb !important;
            box-shadow: 0 0 15px rgba(0, 198, 251, 0.2) !important;
        }

        .form-floating>label {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
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
