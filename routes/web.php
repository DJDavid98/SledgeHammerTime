<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\StaticController;
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
  Route::get('login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::put('/settings/{discordUserId}', [BotSettingsController::class, 'set'])->name('settings.set');
  Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/discord', [RedirectController::class, 'discord']);
Route::get('/bot-login/{discordUserId}/{locale}', [AuthController::class, 'botLogin'])->name('botLogin');
Route::get('/{locale?}', [HomeController::class, 'index'])->name('home');
Route::get('/{locale}/discord', [RedirectController::class, 'discord'])->name('discord');

Route::middleware('guest')->group(function () {
  Route::get('/oauth/callback/{provider}', [AuthController::class, 'callback']);
  Route::get('/{locale}/oauth/redirect/{provider}', [AuthController::class, 'redirect']);
});

$languages = config('languages');
$addLocalePrefix = function (string $path, bool $set_names):string {
  return $set_names ? "/{locale}$path" : $path;
};
$defineRoutes = function (bool $set_names) use ($addLocalePrefix) {
  $settingsRoute = Route::middleware('auth')->get($addLocalePrefix('/settings', $set_names), [BotSettingsController::class, 'edit']);
  $profileEditRoute = Route::middleware('auth')->get($addLocalePrefix('/profile', $set_names), [ProfileController::class, 'edit']);
  $addBotRoute = Route::get($addLocalePrefix('/add-bot', $set_names), [StaticController::class, 'addBot']);
  $addBotRedirectRoute = Route::get($addLocalePrefix('/add-bot/{installType}', $set_names), [RedirectController::class, 'addBotLink']);
  $designRoute = Route::get($addLocalePrefix('/design', $set_names), [StaticController::class, 'design']);
  $loginRoute = Route::middleware('guest')->get($addLocalePrefix('/login', $set_names), [AuthController::class, 'login']);

  Route::middleware('guest')->get($addLocalePrefix('/oauth/callback/{provider}', $set_names), [AuthController::class, 'callback']);

  if ($set_names){
    $loginRoute->name('login');
    $settingsRoute->name('settings');
    $profileEditRoute->name('profile.edit');
    $addBotRoute->name('addBot');
    $addBotRedirectRoute->name('addBotRedirect');
    $designRoute->name('design');
  }
};
foreach ($languages as $language => $_){
  Route::prefix($language)->group(function () use ($defineRoutes) {
    $defineRoutes(false);
  });
}
$defineRoutes(true);

