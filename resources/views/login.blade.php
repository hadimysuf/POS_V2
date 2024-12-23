@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center py-5">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card border-0 shadow-xl" style="background: linear-gradient(145deg, #ffffff, #f6f7fb); border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(45deg, #2D3748, #4A5568); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Point Of Sales</h2>
                        <p class="text-muted lead">Masuk ke Akun Anda</p>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="needs-validation">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="form-floating mb-3">
                            <input 
                                type="email" 
                                class="form-control form-control-lg bg-light border-0 shadow-sm @error('username') is-invalid @enderror" 
                                id="email" 
                                name="username" 
                                placeholder="name@example.com"
                                required
                                autofocus
                            >
                            <label for="email">
                                <i class="bi bi-envelope me-2 "></i>email@address
                            </label>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-floating mb-3">
                            <input 
                                type="password" 
                                class="form-control form-control-lg bg-light border-0 shadow-sm @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="password"
                                required
                                autofocus
                            >
                            <label for="password">
                                <i class="bi bi-envelope me-2 "></i>password
                            </label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" 
                                class="btn btn-primary btn-lg w-100 mb-4 fw-bold" 
                                style="border-radius: 15px; background: linear-gradient(45deg, #4F46E5, #7C3AED); border: none; height: 60px;">
                            <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
                        </button>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Don't have an account? 
                                <a href="{{ route('register') }}" 
                                   class="text-decoration-none fw-bold" 
                                   style="color: #4F46E5;">
                                    Sign up
                                </a>
                            </p>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .form-control:focus {
        border-color: #4F46E5;
        box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.1);
    }
    
    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
        color: #4F46E5;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#4F46E5'
            });
        });
    </script>
@endif
@endsection
