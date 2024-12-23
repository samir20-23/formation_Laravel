<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\PkgProjets\Controllers\ArticleController;
use Modules\PkgProjets\Controllers\Projet2Controller;

Auth::routes() ;

// Route::middleware('auth')->group(function () {
//     Route::prefix('/')->group(function () {
//         Route::resource('projets', Projet2Controller::class);
//     });
// });

// Route::middleware('auth')->group(function () {
//     Route::resource('projets', Projet2Controller::class);
// });

// Route::middleware('auth')->group(function () {
//     Route::resource('tags', Projet2Controller::class);
// });

