<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController; 
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
}); 

Route::resource('posts', PostController::class);
Route::resource('tags', TagController::class);
Route::resource('categories', CategoryController::class);
