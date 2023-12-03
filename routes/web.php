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
  Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/discord', [HomeController::class, 'discord'])->name('discord');
Route::get('/{locale?}', [HomeController::class, 'index'])->name('home');
Route::middleware('guest')->get('/oauth/callback/{provider}', [AuthController::class, 'callback']);

$languages = config('languages');
$addLocalePrefix = function (string $path, bool $name):string {
  return $name ? "/{locale}$path" : $path;
};
$defineRoutes = function (bool $name) use ($addLocalePrefix) {
  $settingsRoute = Route::get($addLocalePrefix('/settings', $name), [BotSettingsController::class, 'edit']);
  $profileEditRoute = Route::get($addLocalePrefix('/profile', $name), [ProfileController::class, 'edit']);
  $loginRoute = Route::middleware('guest')->get($addLocalePrefix('/login', $name), [AuthController::class, 'login']);
  Route::middleware('guest')->get($addLocalePrefix('/oauth/callback/{provider}', $name), [AuthController::class, 'callback']);

  if ($name){
    Route::middleware('guest')->get($addLocalePrefix('/oauth/redirect/{provider}', true), [AuthController::class, 'redirect']);
    $settingsRoute->name('settings');
    $profileEditRoute->name('profile.edit');
    $loginRoute->name('login');
  }
};
foreach ($languages as $language => $_){
  Route::prefix($language)->group(function () use ($defineRoutes) {
    $defineRoutes(false);
  });
}
$defineRoutes(true);

