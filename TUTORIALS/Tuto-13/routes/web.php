<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', function () {
    $user = Auth::user(); // Retrieve the authenticated user
    $articles = $user->articles; // Retrieve the user's articles
    
    return view('dashboard', compact('user', 'articles'));
})->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
