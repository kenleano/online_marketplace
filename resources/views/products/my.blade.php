{{-- resources/views/products/my.blade.php --}}
@extends('layouts.app')

@section('content')
<link href="{{ asset('css/products-my.css') }}" rel="stylesheet">
<div class="container">
    <h2>My Products</h2>
    <div class="product-list">
    <a href="{{ route('products.create') }}" class="btn btn-primary">Post Product</a>
        @foreach ($products as $product)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top">
                <p class="card-text">{{ $product->description }}</p>
                <div class="button-group">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
