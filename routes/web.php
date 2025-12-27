<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::post('/client/request', [PageController::class, 'clientRequest'])->name('client.request');
Route::get('/search', [PageController::class, 'search'])->name('search');


