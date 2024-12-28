@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Welcome, {{ $username }}</h1>
        <p>You are logged in as: <strong>{{ $role }}</strong></p>

        <div class="d-flex gap-3 mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Manage Users</a>
            
            <a href="{{ route('history.index') }}" class="btn btn-info">Transaction History</a>
        </div>
    </div>
@endsection