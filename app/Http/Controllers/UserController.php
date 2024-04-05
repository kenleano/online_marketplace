<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the application registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        Log::info('Registering user', $request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in or redirect
        return redirect()->route('products.index'); // Adjust the route as necessary
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        // Check if the logged-in user is an admin
        if (Auth::user()->role === 'admin') {
            return view('users.edit', compact('user'));
        } else {
            // Redirect or display an error message for regular users
            return redirect()->back()->with('error', 'You do not have permission to edit this user.');
        }
    }

    // Delete a user
    public function destroy($id)
    {
        // Check if the logged-in user is an admin
        if (Auth::user()->role === 'admin') {
            User::findOrFail($id)->delete();
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        } else {
            // Redirect or display an error message for regular users
            return redirect()->back()->with('error', 'You do not have permission to delete this user.');
        }
    }

    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $users = User::all(); // Fetch all users
            return view('admin.users', compact('users'));
        } else {
            // If the user is not an admin, redirect them or show an error
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }
    }
}
