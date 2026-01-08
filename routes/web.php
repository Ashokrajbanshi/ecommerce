<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/client/request', [PageController::class, 'clientRequest'])->name('client.request');
Route::get('/search', [PageController::class, 'search'])->name('search');
Route::get('/product/{id}', [PageController::class, 'product'])->name('product');

// route of cart
Route::get('/cart', [PageController::class, 'viewCart'])->name('cart');
Route::post('/cart/add', [PageController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [PageController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [PageController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [PageController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/count', [PageController::class, 'getCartCount'])->name('cart.count');

// In your routes/web.php, add this after your existing checkout route:
Route::get('/checkout/{id}', [PageController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [PageController::class, 'processCheckout'])->name('checkout.process');
Route::get('/order/confirmation/{id}', [PageController::class, 'orderConfirmation'])->name('order.confirmation');

Route::get('/khalti/callback', [PageController::class, 'khaltiCallback'])->name('khalti.callback');

// // Wishlist routes
// // Add these routes after your cart routes
// Route::get('/wishlist', [PageController::class, 'viewWishlist'])->name('wishlist.index')->middleware('auth');
// Route::post('/wishlist/toggle/{product_id}', [PageController::class, 'toggleWishlist'])->name('wishlist.toggle')->middleware('auth');
// Route::get('/wishlist/count', [PageController::class, 'getWishlistCount'])->name('wishlist.count');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/google/redirect', [AuthController::class, 'google_redirect'])->name('google_redirect');
Route::get('/google/callback', [AuthController::class, 'google_callback'])->name('google_callback');
Route::post('/login', [AuthController::class, 'login'])->name('login');

require __DIR__.'/auth.php';
