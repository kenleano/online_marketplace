<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController; // Remember to use your actual controller namespace
use App\Http\Controllers\MessageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// Show the form for creating a new product - This needs to come before the '/products/{product}' route
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware('auth');

// Routes for products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth');
// Make sure this route is defined after '/products/create' to avoid conflict
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/my-products', [ProductController::class, 'myProducts'])->name('products.my')->middleware('auth');
// Place these inside the group with 'middleware' => 'auth' to protect them
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit')->middleware('auth');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('auth');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('auth');


// Registration and login routes
Route::get('register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [UserController::class, 'register'])->name('user.register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Dashboard and logout
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users')->middleware('auth');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');

Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
// Example of correct route definition
Route::get('/messages/create/{seller_id}/{product_id}', [MessageController::class, 'showCreateForm'])->name('messages.createform');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('/messages/reply/{message}', [MessageController::class, 'reply'])->name('messages.reply')->middleware('auth');
