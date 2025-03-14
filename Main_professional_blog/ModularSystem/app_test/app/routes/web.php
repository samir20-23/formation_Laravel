<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/products', [ProductController::class, 'index'])->middleware('auth');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/public', [ProductController::class, 'home']);
Route::resource('/products', ProductController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
