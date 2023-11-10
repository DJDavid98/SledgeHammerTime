<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/oauth/redirect/{provider}', [AuthController::class, 'redirect']);
    Route::get('/oauth/callback/{provider}', [AuthController::class, 'callback']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
