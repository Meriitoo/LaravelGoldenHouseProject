<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login.submit', [UserController::class, 'login'])->name('login.submit');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::resource('posts', PostController::class);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/posts/{post}/buy', [PostController::class, 'buy'])->name('posts.buy');

Route::middleware(['auth'])->group(function () {
    // Route::resource('posts', PostController::class);
    Route::resource('posts', PostController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::post('/posts/{post}/buy', [PostController::class, 'buy'])->name('posts.buy');
    Route::post('/posts/{post}/cancel', [PostController::class, 'cancelPurchase'])->name('posts.cancelPurchase');
});




