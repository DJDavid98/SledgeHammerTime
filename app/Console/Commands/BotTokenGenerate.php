<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Uid\Uuid;

class BotTokenGenerate extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'bot-token:generate';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Creates a Sanctum API token for the Discord bot';

  /**
   * Execute the console command.
   */
  public function handle() {
    $consoleUserId = env('APP_CONSOLE_USER_UUID');
    if (empty($consoleUserId)){
      $this->info('Console user UUID is missing in .env file, it wil be generated');
      $consoleUserId = Uuid::v4();
      if (!$this->writeNewEnvironmentFileWith($consoleUserId)){
        return;
      }
    }
    $consoleUser = User::firstOrCreate(['id' => $consoleUserId], ['name' => 'Console']);
    $this->info("Generating token for user $consoleUser->name with ID $consoleUser->id");
    $token = $consoleUser->createToken('Bot token');

    $this->info("Your bot token is: <comment>{$token->plainTextToken}</comment>");
  }

  /**
   * Write a new environment file with the given user ID.
   *
   * @param string $consoleUserId
   *
   * @return bool
   */
  protected function writeNewEnvironmentFileWith(string $consoleUserId):bool {
    $envVarName = 'APP_CONSOLE_USER_UUID';
    $replaced = preg_replace(
      "/^$envVarName=.*$/m",
      "$envVarName=$consoleUserId",
      $input = file_get_contents($this->laravel->environmentFilePath())
    );

    if ($replaced === $input || $replaced === null){
      $this->error("Unable to set console user UUID. No $envVarName variable was found in the .env file.");

      return false;
    }

    file_put_contents($this->laravel->environmentFilePath(), $replaced);
    $this->info("Wrote $envVarName with value $consoleUserId to .env file.");

    return true;
  }
}
