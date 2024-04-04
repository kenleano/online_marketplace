{{-- resources/views/products/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Method spoofing to make HTTP PUT request --}}

        {{-- Product Name --}}
        <div>
            <label for="name">Product Name:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        {{-- Product Description --}}
        <div>
            <label for="description">Description:</label>
            <textarea name="description" required>{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Product Price --}}
        <div>
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
        </div>

        {{-- Product Image --}}
        <div>
            <label for="image">Product Image:</label>
            <input type="file" name="image">
            @if($product->image)
                <p>Current Image:</p>
                <img src="{{ $product->image }}" alt="Product Image" style="max-width: 200px;">
            @endif
        </div>

        {{-- Submit Button --}}
        <button type="submit">Update Product</button>
    </form>
</div>
@endsection
