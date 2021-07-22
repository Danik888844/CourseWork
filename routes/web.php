<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/','posts');

Route::resource('posts', \App\Http\Controllers\PostController::class)
    ->only('index','show');

Route::delete('posts/{post}/image',[\App\Http\Controllers\Admin\PostController::class, 'deleteImage'])
->name('admin.posts.deleteImage');

Route::resource('tags', \App\Http\Controllers\TagController::class)
    ->only('show');
