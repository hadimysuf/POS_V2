@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($username))
        <h1>Welcome, {{ $username }}</h1>
    @else
        <h1>Welcome, Guest</h1>
    @endif
    <p>Selamat datang di sistem Point of Sales!</p>

</div>
@endsection
