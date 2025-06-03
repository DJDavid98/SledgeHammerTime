<?php

namespace App\Console\Commands;

use App\Models\BotCommandOption;
use App\Models\TelemetryCommandOptionUse;
use Illuminate\Console\Command;

class UpdateBotCommandOptionTotalUses extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:update-bot-command-option-total-uses';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update total uses for bot command options';

  /**
   * Execute the console command.
   */
  public function handle() {
    $executionData = TelemetryCommandOptionUse::groupBy('bot_command_option_id')->selectRaw('bot_command_option_id, count(*) as total_uses')->get();

    foreach ($executionData as $execution){
      $command = BotCommandOption::find($execution['bot_command_option_id']);
      if ($command === null){
        $this->warn("Command option with ID {$execution['bot_command_option_id']} not found");
        continue;
      }
      $command->total_uses = $execution['total_uses'];
      $command->save();
    }
  }
}
