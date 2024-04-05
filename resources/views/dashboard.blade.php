{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<div class="container">
    <div class="form-wrapper">
        <h1 class="form-title">Dashboard</h1>
        <div class="dashboard-item">
            <div class="dashboard-content">
                <h5 class="dashboard-title">Welcome, {{ Auth::user()->name }}!</h5>
                <p class="dashboard-text">You are logged in.</p>
            </div>
        </div>

        <div class="dashboard-item">
            <div class="dashboard-content">
                <h5 class="dashboard-title">Post a Product</h5>
                <p class="dashboard-text">Click the button below to post a new product listing.</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Post Product</a>
            </div>
        </div>

        <div class="dashboard-item">
            <div class="dashboard-content">
                <h5 class="dashboard-title">Edit Profile</h5>
                <p class="dashboard-text">Update your profile information.</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>

        <div class="dashboard-item">
            <div class="dashboard-content">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
