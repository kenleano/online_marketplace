@extends('layouts.app')

@section('content')
<link href="{{ asset('css/products.css') }}" rel="stylesheet">
<main>
<h1>Products</h1>
    <section class="container">
     
        @foreach ($products as $product)
        <div class="card">
            <div>
                <img class="card-img" src="{{ $product->image }}" />
            </div>
            <div class="card-text">
                <h1>{{ $product->name }}</h1>
                <p class="ellipsis">{{ $product->description }}</p>
                <div class="text-price">${{ $product->price }}</div>
                <div class="card-inner">
                    <button>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn--block card__btn">View</a></button>
                </div>
            </div>
        </div>
        @endforeach
    </section>
</main>
{{ $products->links() }}
@endsection

@push('styles')
<link href="{{ asset('css/products.css') }}" rel="stylesheet">
@endpush