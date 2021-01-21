<?php

use App\Http\Controllers\UserController;

Route::resource('users', UserController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
