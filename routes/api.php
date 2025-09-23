<?php

use App\Http\Controllers\AdminController;
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

// Rotas Públicas
Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('posts/{slug}', [PostController::class, 'getPost']);
Route::get('posts/{slug}/related', [PostController::class, 'getRelatedPosts']);

// Rotas de Gestão (privadas)
// - Necessitam de Autenticação (Bearer)
// - Retornam e atuam só em posts o Usuário
// - Prefixo /admin

// admin/posts (Pegar todos os posts, inclusive drafts com paginação)
// admin/posts/{slug} (Pegar um único específico)
// POST admin/posts (Criar um novo post)
// PUT admin/posts/{slug} (Atualizar dados de um post específico)
// Delete admin/*posts/{slug} (Deletar um post específico)

Route::prefix('admin')->middleware(('auth:sanctum'))->group(function () {
    Route::get('/posts', [AdminController::class, 'getPosts']);
});
