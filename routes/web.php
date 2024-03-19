<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the cleiton Store'
    ]);
});


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

Route::post('users', [UserController::class, 'create']);
