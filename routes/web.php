<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the cleiton Store'
    ]);
});

//routes that need authentication
Route::group([
    'middleware' => 'api',
    
],
    function ($router) {
        
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('me', [AuthController::class, 'me']);
    }
);

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'getCategories']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::get('/{id}', [CategoryController::class, 'getCategoryById']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'delete']);
});

Route::post('users', [UserController::class, 'create']);
