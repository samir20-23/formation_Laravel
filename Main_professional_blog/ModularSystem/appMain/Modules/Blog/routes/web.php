<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('blog', BlogController::class)->names('blog');
// });
 

Route::prefix('blog')->group(function () {
    Route::get('/', [BlogController::class, 'index']);
});
