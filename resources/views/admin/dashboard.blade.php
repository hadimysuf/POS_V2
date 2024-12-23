
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, {{ $username }}</h1>
        <p>You are logged in as: <strong>{{ $role }}</strong></p>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Manage Users</a>
        <a href="{{ route('history.index') }}" class="btn btn-info">Transaction History</a>
    </div>
@endsection
