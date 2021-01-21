<?php

use App\Http\Controllers\UserController;

Route::get('users', [UserController::class, 'index']);
