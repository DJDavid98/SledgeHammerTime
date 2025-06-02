<?php

namespace App\Console\Commands;

use App\Models\BotCommand;
use App\Models\TelemetryCommandExecution;
use Illuminate\Console\Command;

class UpdateBotCommandTotalExecutions extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:update-bot-command-total-executions';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Execute the console command.
   */
  public function handle() {
    $executionData = TelemetryCommandExecution::groupBy('bot_command_id')->selectRaw('bot_command_id, count(*) as total_executions')->get();

    foreach ($executionData as $execution){
      $command = BotCommand::find($execution['bot_command_id']);
      if ($command === null){
        $this->warn("Command with ID {$execution['id']} not found");
        continue;
      }
      $command->total_executions = $execution['total_executions'];
      $command->save();
    }
  }
}
