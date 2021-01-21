<?php

use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::post('login', [AuthController::class, 'login']);
