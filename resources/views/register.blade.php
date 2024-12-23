@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center min-vh-100 align-items-center py-5">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card border-0 shadow-xl" style="background: linear-gradient(145deg, #ffffff, #f6f7fb); border-radius: 20px;">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-5">
                        <h2 class="display-4 fw-bold mb-3" style="background: linear-gradient(45deg, #2D3748, #4A5568); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Buat Akun Anda</h2>
                        <p class="text-muted lead">Silahkan Masukan Data User Baru</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-3">
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
                                <div class="form-floating">
                                    <input type="text" name="nama_user" class="form-control form-control-lg bg-light border-0 shadow-sm" 
                                           id="nama_user" value="{{ old('nama_user') }}" required 
                                           style="border-radius: 15px; height: 60px;">
                                           <label class="text-muted">
                                            <i class="fa-solid fa-at me-2"></i>nama user
                                        </label>
                                </div>
                                
                                @error('nama_user')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Username & Password -->
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="username" class="form-control form-control-lg bg-light border-0 shadow-sm" 
                                           value="{{ old('username') }}" required 
                                           style="border-radius: 15px; height: 60px;">
                                    <label class="text-muted">
                                        <i class="fa-solid fa-at me-2"></i>Username
                                    </label>
                                </div>
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="password" name="password" class="form-control form-control-lg bg-light border-0 shadow-sm" 
                                           required style="border-radius: 15px; height: 60px;">
                                    <label class="text-muted">
                                        <i class="fa-solid fa-lock me-2"></i>Password
                                    </label>
                                </div>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Role Selection -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select form-select-lg bg-light border-0 shadow-sm" 
                                            id="role_id" name="role_id" required 
                                            style="border-radius: 15px; height: 60px;">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id_role }}" {{ old('role_id') == $role->id_role ? 'selected' : '' }}>
                                                {{ $role->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label class="text-muted">
                                        <i class="fa-solid fa-user-shield me-2"></i>Role
                                    </label>
                                </div>
                                @error('role_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="tel" name="nomor_handphone" class="form-control form-control-lg bg-light border-0 shadow-sm" 
                                           value="{{ old('nomor_handphone') }}" required placeholder="(+62)8"
                                           style="border-radius: 15px; height: 60px;">
                                    <label class="text-muted">
                                        <i class="fa-solid fa-phone me-2"></i>Phone Number
                                    </label>
                                </div>
                                <small class="text-muted">*Must be 8-12 digits</small>
                                @error('nomor_handphone')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="col-12 col-md-6">
                                <div class="form-floating">
                                    <input type="text" name="alamat" class="form-control form-control-lg bg-light border-0 shadow-sm" 
                                           value="{{ old('alamat') }}" required placeholder="Start with 'Jl.'"
                                           style="border-radius: 15px; height: 60px;">
                                    <label class="text-muted">
                                        <i class="fa-solid fa-location-dot me-2"></i>Address
                                    </label>
                                </div>
                                @error('alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-4">
                                <div class="d-flex flex-column flex-md-row gap-3 justify-content-md-between align-items-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold" 
                                            style="border-radius: 15px; background: linear-gradient(45deg, #4F46E5, #7C3AED); border: none;">
                                        <i class="fa-solid fa-user-plus me-2"></i>Register
                                    </button>
                                    <a href="{{ url('login') }}" class="btn btn-light btn-lg px-5" 
                                       style="border-radius: 15px; background: linear-gradient(45deg, #F3F4F6, #E5E7EB); border: none;">
                                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this in your layout file if not already present -->
@push('styles')
<style>
    .form-control:focus, .form-select:focus {
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
@endsection
