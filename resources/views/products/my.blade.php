{{-- resources/views/products/my.blade.php --}}
@extends('layouts.app')

@section('content')
<link href="{{ asset('css/products-my.css') }}" rel="stylesheet">
<h2>My Products</h2>
<div class="button-container">
        <button class="btn-post"> <a href="{{ route('products.create') }}" class="btn btn-primary">Post Product</a></button>
    </div>

<div class="container">

    <div class="product-list">

        @foreach ($products as $product)
        <div class="product-card">
            <div class="product-card-body">
           
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-img">
                <h5 class="product-title">{{ $product->name }}</h5>

                <p class="product-description">{{ $product->description }}</p>
                <p> Status: {{ $product->status }}</p>
                <div class="button-group">
               <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary"> <button class="btn-edit"> Edit</button></a>
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
