<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\RegisterController;

Route::post('/register', [RegisterController::class, 'register']);

