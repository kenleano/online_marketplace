<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Cloudinary\Cloudinary;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'for_sale')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        $product = \App\Models\Product::findOrFail($productId);

        return view('products.show', compact('product'));
    }

    public function create()
    {
        // Return the view with the form for creating a new product
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'image_url' => 'nullable|string', // Validate the image URL
        ]);

        // Add the user_id to the validated data array
        $validatedData['user_id'] = Auth::id();
        $validatedData['image'] = $validatedData['image_url']; // Use the image URL from Cloudinary
        unset($validatedData['image_url']); // Remove the extra 'image_url' field

        // Create the product record in the database
        $product = Product::create($validatedData);

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Product posted successfully!');
    }

    public function myProducts()
    {
        // Fetch products posted by the authenticated user
        $products = Product::where('user_id', Auth::id())->get();

        // Return a view, passing the user's products
        return view('products.my', compact('products'));
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);

        // Ensure the user is authorized to edit the product
        if (Auth::id() !== $product->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('products.edit', compact('product'));
    }


    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        // Ensure the user is authorized to delete the product
        if (Auth::id() !== $product->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.my')->with('success', 'Product deleted successfully.');
    }

    public function update(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Ensure the user is authorized to update the product
        if (Auth::id() !== $product->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'status' => 'required|in:for_sale,sold',
            // Add validation for the image if you're handling image uploads
        ]);

        // Update the product with validated data
        $product->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('products.my')->with('success', 'Product updated successfully!');
    }
}
