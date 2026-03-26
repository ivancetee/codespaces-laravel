<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

Route::get('/products',        [ProductController::class,  'index']);
Route::get('/products/{id}',   [ProductController::class,  'show']);

Route::get('/categories',             [CategoriaController::class, 'index']);
Route::get('/categories/{id}',        [CategoriaController::class, 'show']);
Route::get('/categories/{id}/products', [CategoriaController::class, 'productos']);


Route::middleware('auth:api')->group(function () {

    Route::get('/me',      [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::middleware('is_admin')->group(function () {

        Route::post('/products',        [ProductController::class,  'store']);
        Route::put('/products/{id}',    [ProductController::class,  'update']);
        Route::delete('/products/{id}', [ProductController::class,  'destroy']);

        Route::post('/categories',        [CategoriaController::class, 'store']);
        Route::put('/categories/{id}',    [CategoriaController::class, 'update']);
        Route::delete('/categories/{id}', [CategoriaController::class, 'destroy']);
    });
});
