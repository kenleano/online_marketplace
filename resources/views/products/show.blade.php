{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('content')

<link href="{{ asset('css/products-show.css') }}" rel="stylesheet">
<div class="product-container">
    <div class="product-image">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">
    </div>
    <div class="product-details">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <div class="product-price">
            <span>${{ $product->price }}</span>
        </div>
    </div>
</div>
@endsection
