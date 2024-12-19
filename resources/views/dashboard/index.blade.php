@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, {{ $username }}</h1>
        <p>You are logged in as: <strong>{{ $role }}</strong></p>

        @if($role === 'admin')
            <a href="{{ route('products.index') }}" class="btn btn-primary">Manage Products</a>
            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">View Transactions</a>
        @elseif($role === 'kasir')
            <a href="{{ route('sales.create') }}" class="btn btn-primary">Create Sale</a>
        @endif
    </div>
@endsection
