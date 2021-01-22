<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('auth/profile',  [AuthController::class, 'profile']);
    Route::post('auth/update',   [AuthController::class, 'update']);
    Route::post('auth/password', [AuthController::class, 'password']);
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
});
