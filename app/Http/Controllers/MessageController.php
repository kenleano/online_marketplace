<?php

namespace App\Http\Controllers;

// app/Http/Controllers/MessageController.php

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;


class MessageController extends Controller
{
    // Show messages
    public function index()
    {
        $user = Auth::user();
    
        // Fetch received messages
        $receivedMessages = Message::where('receiver_id', $user->id)->latest()->get();
    
        // Fetch sent messages
        $sentMessages = Message::where('sender_id', $user->id)->latest()->get();
    
        return view('messages.index', compact('receivedMessages', 'sentMessages'));
    }
    
    // Create a new message
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'message' => 'required|string',
        ]);

        // Create the message record in the database
        $validatedData['sender_id'] = Auth::id();
        Message::create($validatedData);

        // Redirect back to the messages page with a success message
        return redirect()->route('messages.index')->with('success', 'Message sent successfully!');
    }
    // MessageController.php
    public function showCreateForm($seller_id, $product_id)
    {
        $product = Product::with('user')->findOrFail($product_id);
        $seller = User::findOrFail($seller_id); // Assuming each product has a 'user' relation for the seller
    
        return view('messages.create', compact('product', 'seller'));
    }
    public function reply($messageId)
{
    $originalMessage = Message::with(['sender', 'receiver', 'product'])->findOrFail($messageId);

    // Ensure the authenticated user is the receiver of the original message
    if (Auth::id() !== $originalMessage->receiver_id) {
        abort(403, 'Unauthorized action.');
    }

    return view('messages.reply', compact('originalMessage'));
}

    
}
