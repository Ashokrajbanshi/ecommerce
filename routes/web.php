<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/client/request', [PageController::class, 'clientRequest'])->name('client.request');
Route::get('/search', [PageController::class, 'search'])->name('search');
Route::get('/product/{id}', [PageController::class, 'product'])->name('product');



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
