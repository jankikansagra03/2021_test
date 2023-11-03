<h1>User Dashboard</h1>

@if (session()->has('user'))
    {{ session('user') }}
@endif
