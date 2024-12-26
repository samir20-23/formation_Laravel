<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/adminlte', function () {
    return view('adminlte::page');
});

// Route::get('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::resource('articles', ArticleController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
