{{-- resources/views/products/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ $product->image }}"  class="card-img-top product-detail-img" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">${{ $product->price }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
