@extends('layouts.app')

@section('content')
<link href="{{ asset('css/messages-create.css') }}" rel="stylesheet">
<div class="container">
    <h1>Send a Message</h1>
    <div class="product-info">
        <h2>Product Details</h2>
        <p><strong>Name:</strong> {{ $product->name }}</p>
        <img src="{{ $product->image }}" alt="{{ $product->name }}" style="max-width: 100px;">
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <p><strong>Seller:</strong> {{ $seller->name }}</p>
    </div>

    <div class="message-form">
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $seller->id }}">
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="message">Your Message</label>
                <textarea name="message" id="message" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>
@endsection
