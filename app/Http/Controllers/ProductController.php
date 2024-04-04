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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional, validate only if provided
        ]);

        // Initialize Cloudinary before the if-statement
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret')
            ],
            'url' => [
                'secure' => true // Use HTTPS
            ]
        ]);

        $uploadedFileUrl = null; // Initialize the variable to hold the Cloudinary URL

        // Handle the product image upload if one was provided
        if ($request->hasFile('image')) {
            // Upload the image to Cloudinary and retrieve the URL
            $uploadResult = $cloudinary->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'product_images', // Optional: specify a folder in Cloudinary
            ]);
            $uploadedFileUrl = $uploadResult['secure_url']; // Get the secure URL from the upload result
        }

        // Prepare the data for saving, including the Cloudinary URL if available
        $dataToSave = array_merge($validatedData, [
            'user_id' => Auth::id(), // Add the user_id
            'image' => $uploadedFileUrl // Add the image URL
        ]);

        // Exclude the image from saving if it's null
        if (is_null($uploadedFileUrl)) {
            unset($dataToSave['image']);
        }

        // Create the product record in the database with the prepared data
        $product = Product::create($dataToSave);

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
}
