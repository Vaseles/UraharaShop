<?php

use App\Http\Controllers\AuthController;
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

    //! Tags
});