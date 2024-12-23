<?php

use Illuminate\Support\Facades\Route;
use Modules\PkgProjets\Controllers\ProjetController;
use Modules\PkgProjets\Controllers\TagController;

// routes for project tags management
Route::middleware('auth')->group(function () {
    Route::prefix('/')->group(function () {
        Route::resource('tags', TagController::class);
        Route::get('tags/export', [TagController::class, 'export'])->name('tags.export');
        Route::post('tags/import', [TagController::class, 'import'])->name('tags.import');
    });
});
