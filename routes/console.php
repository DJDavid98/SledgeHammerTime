<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('create:bot-token', function () {
  $consoleUserId = env('APP_CONSOLE_USER_UUID');
  if (!isset($consoleUserId)){
    throw new Error('Console user UUID is not specified!');
  }
  $consoleUser = User::createOrFirst(['id' => $consoleUserId], ['name' => 'Console']);
  $token = $consoleUser->createToken('Bot token');

  /** @var $this \Illuminate\Console\Command */
  $this->info("Your bot token is:");
  $this->comment($token->plainTextToken);
})->purpose('Creates a token for the Discord bot that allows interacting with the API');
