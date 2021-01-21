<?php

use App\Http\Controllers\UserController;

Route::get('hello', [UserController::class, 'index']);
