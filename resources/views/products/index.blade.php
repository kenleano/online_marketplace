@extends('layouts.app')

@section('content')
<link href="{{ asset('css/products.css') }}" rel="stylesheet">
<main>
    <h1>Products</h1>
    <section class="container">
        @foreach ($products as $product)
        @if ($product->user_id !== Auth::id() && $product->status !== 'sold')
        <div class="card">
            <div>
                <img class="card-img" src="{{ $product->image }}" alt="{{ $product->name }}" />
            </div>
            <div class="card-text">
                <h1>{{ $product->name }}</h1>
                <p class="ellipsis">{{ $product->description }}</p>
                <div class="text-price">${{ number_format($product->price, 2) }}</div>
                <div class="card-inner">
                    <button>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn--block card__btn">View</a>
                    </button>
                    <form action="{{ route('messages.createform', ['seller_id' => $product->user_id, 'product_id' => $product->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn--block card__btn">Message Seller</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </section>
</main>
{{ $products->links() }}
@endsection

@push('styles')
<link href="{{ asset('css/products.css') }}" rel="stylesheet">
@endpush
