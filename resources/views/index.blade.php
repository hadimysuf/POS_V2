@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($username))
        <h1>Welcome, {{ $username }}</h1>
    @else
        <h1>Welcome, Guest</h1>
    @endif
    <p>Selamat datang di sistem Point of Sales!</p>
    <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
</div>
@endsection
