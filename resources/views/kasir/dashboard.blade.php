@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, {{ $username }}</h1>
        <p>You are logged in as: <strong>{{ $role }}</strong></p>

        <a href="{{ route('sales.create') }}" class="btn btn-primary">Create New Sale</a>
        
    </div>
@endsection
