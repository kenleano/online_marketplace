@extends('layouts.app')

@section('content')
<h1>Products</h1>
<div class="container">

    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ $product->image}}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">${{ $product->price }}</span>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $products->links() }}
</div>
@endsection