<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/contact', 'ContactController@create');
Route::post('/contact', 'ContactController@store');