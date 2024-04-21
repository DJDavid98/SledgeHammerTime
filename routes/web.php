<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
  Route::get('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::put('/settings/{discordUserId}', [BotSettingsController::class, 'set'])->name('settings.set');
  Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/discord', [HomeController::class, 'discord'])->name('discord');
Route::get('/bot-login/{discordUserId}/{locale}', [AuthController::class, 'botLogin'])->name('botLogin');
Route::get('/{locale?}', [HomeController::class, 'index'])->name('home');
Route::middleware('guest')->get('/oauth/callback/{provider}', [AuthController::class, 'callback']);
Route::middleware('guest')->get('/login', [AuthController::class, 'login'])->name('login');

$languages = config('languages');
$addLocalePrefix = function (string $path, bool $name):string {
  return $name ? "/{locale}$path" : $path;
};
$defineRoutes = function (bool $name) use ($addLocalePrefix) {
  $settingsRoute = Route::middleware('auth')->get($addLocalePrefix('/settings', $name), [BotSettingsController::class, 'edit']);
  $profileEditRoute = Route::middleware('auth')->get($addLocalePrefix('/profile', $name), [ProfileController::class, 'edit']);
  Route::middleware('guest')->get($addLocalePrefix('/oauth/callback/{provider}', $name), [AuthController::class, 'callback']);

  if ($name){
    Route::middleware('guest')->get($addLocalePrefix('/oauth/redirect/{provider}', true), [AuthController::class, 'redirect']);
    Route::middleware('guest')->get($addLocalePrefix('/login', $name), [AuthController::class, 'login']);
    $settingsRoute->name('settings');
    $profileEditRoute->name('profile.edit');
  }
};
foreach ($languages as $language => $_){
  Route::prefix($language)->group(function () use ($defineRoutes) {
    $defineRoutes(false);
  });
}
$defineRoutes(true);

