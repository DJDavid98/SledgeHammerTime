<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class BotTokenClear extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'bot-token:clear';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Remove all Sanctum API tokens for the console user';

  /**
   * Execute the console command.
   */
  public function handle() {
    $consoleUserId = env('APP_CONSOLE_USER_UUID');
    if (!isset($consoleUserId)){
      $this->error('Console user UUID is missing in .env file');

      return;
    }
    $consoleUser = User::firstOrCreate(['id' => $consoleUserId], ['name' => 'Console']);

    $tokens = $consoleUser->tokens()->get();
    $tokenCount = $tokens->count();

    if ($tokenCount === 0){
      $this->info("The user $consoleUser->name with ID $consoleUser->id has no tokens");

      return;
    }

    $this->info("Deleting {$tokens->count()} tokens for user $consoleUser->name with ID $consoleUser->id");
    $this->withProgressBar($tokens, function ($token) {
      $token->delete();
    });

    $this->line('');

    $this->info("Tokens deleted successfully.");
  }
}
