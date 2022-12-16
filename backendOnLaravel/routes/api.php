<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    
    //! Authentication
    Route::prefix('auth')->group(function () {
        Route::post('signin', [AuthController::class,'login']);
        Route::post('signup', [AuthController::class, 'register']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('signout', [AuthController::class, 'logout']);
        });
    });

    //! USER
    Route::get('user/{name}/', [AuthController::class, 'user']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('user/{name}/', [AuthController::class, 'changeUser']);
        Route::delete('user/{name}/', [AuthController::class, 'destroyAccount']);
    });

    //! CATEGORY
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{name}/', [CategoryController::class, 'show']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('categories', [CategoryController::class, 'create']);
        Route::delete('categories/{name}/', [CategoryController::class, 'delete']);  
    });

    //! PRODUCT
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{slug}/', [ProductController::class,'show']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('products', [ProductController::class, 'create']);
        Route::put('products/{slug}/', [ProductController::class, 'update']);
        Route::delete('products/{slug}/', [ProductController::class, 'delete']);
    });

    //! COMMENTS
    Route::get('products/{slug}/comments', [CommentController::class, 'index']);
    Route::get('products/{slug}/comments/{id}/', [CommentController::class, 'show']);
    
    Route::middleware('auth:sanctum')->group(   function () {
        Route::post('products/{slug}/comments', [CommentController::class, 'create']);
        Route::delete('products/{slug}/comments/{id}/', [CommentController::class, 'delete']);
        Route::put('products/{slug}/comments/{id}/', [CommentController::class, 'update']);

    });
});