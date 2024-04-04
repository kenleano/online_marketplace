<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Welcome')</title>
    <!-- Link to Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="nav-container">
            <!-- Left-aligned items -->
            <div class="nav-left">
                <a href="{{ url('/') }}">Home</a>
            </div>

            <!-- Right-aligned items -->
            <div class="nav-right">
                @if(Auth::check())
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <a href="{{ route('products.my') }}">My Products</a> <!-- Add this line -->
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
                @else
                <a href="{{ route('register') }}">Register</a>
                <a href="{{ route('login') }}">Login</a>
                @endif
            </div>

        </div>
    </nav>


    <main class="py-4">
        @yield('content')
    </main>
</body>

</html>