<?php

use App\Http\Controllers\BotApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function ($route) {
  Route::get('/user', [BotApiController::class, 'user']);
  Route::post('/login-link/{discordUserId}/{locale}', [BotApiController::class, 'loginLink']);
});
