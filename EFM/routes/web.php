<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
Route::get('/', function() {
    return view('posts.index');
});
Route::resource('posts', PostController::class);
Route::get('posts-export', [PostController::class, 'export'])->name('posts.export');
Route::post('posts-import', [PostController::class, 'import'])->name('posts.import');