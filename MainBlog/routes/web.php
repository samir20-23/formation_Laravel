<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController; 
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;

Route::resource('/', PostController::class);

// Post Routes
Route::resource('posts', PostController::class);

// Tag Routes
Route::resource('tags', TagController::class);

// Category Routes
Route::resource('categories', CategoryController::class);
