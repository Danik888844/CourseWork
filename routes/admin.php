<?php

use \Illuminate\Support\Facades\Route;

Route::get('/',\App\Http\Controllers\Admin\DashboardController::class)
    ->name('dashboard');

Route::resource('tags',\App\Http\Controllers\Admin\TagController::class);
Route::resource('posts',\App\Http\Controllers\Admin\PostController::class);

