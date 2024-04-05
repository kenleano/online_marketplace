{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('content')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
<div class="container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('user.register') }}">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label for="email">Email Address:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit">Register</button>
    </form>
</div>
@endsection
