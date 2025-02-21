<?php

use Illuminate\Support\Facades\Route;

Route::get('/', action: [App\Http\Controllers\WelcomeController::class, 'form']);
Route::post('/post', action: [App\Http\Controllers\WelcomeController::class, 'post']);

