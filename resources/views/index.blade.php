@if(session('username'))
    <h1>Welcome, {{ session('username') }}</h1>
@else
    <p>Please login first.</p>
@endif
