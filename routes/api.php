<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth
Route::prefix('auth')->group(function () {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::post('/validate', [AuthController::class, 'validate'])->middleware('auth:sanctum');
});

Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('posts/{slug}', [PostController::class, 'getPost']);
Route::get('posts/{slug}/related', [PostController::class, 'getRelatedPosts']);
