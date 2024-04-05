@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Your profile edit form fields go here -->
        <!-- Example: -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
        </div>

        <!-- Add more fields as needed -->

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
