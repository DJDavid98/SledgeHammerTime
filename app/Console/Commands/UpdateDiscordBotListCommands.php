<?php

namespace App\Console\Commands;

use App\Models\BotCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateDiscordBotListCommands extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:update-dbl-commands';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update bot commands on the DiscordBotList tracking service';

  /**
   * Execute the console command.
   */
  public function handle() {
    $token = config('services.discord-bot-list.token');
    if (empty($token)){
      $this->warn("You do not have a DiscordBotList token set, which is required to use this command.");

      return 1;
    }
    $botId = config('services.discord-bot-list.bot_id');
    if (empty($botId)){
      $this->warn("You do not have a DiscordBotList bot ID set, which is required to use this command.");

      return 1;
    }

    $commandsData = BotCommand::all()->map(fn(BotCommand $command) => [
      'name' => $command->name,
      'description' => $command->description,
      'type' => $command->type,
    ]);
    $this->info("Updating DiscordBotList bot commands…\n".var_export($commandsData, return: true));

    $endpoint = sprintf("/bots/%s/commands", config('services.discord-bot-list.bot_id'));
    $result = Http::asJson()
      ->baseUrl(config('services.discord-bot-list.base_url'))
      ->withHeaders([
        'Authorization' => $token,
      ])
      ->post($endpoint, $commandsData);

    $statusCode = $result->getStatusCode();
    if ($statusCode !== 200){
      $this->fail(implode("\n", [
        "Failed to update bot commands on DiscordBotList, got HTTP $statusCode",
        "Response headers:",
        var_export($result->getHeaders(), return: true),
        "Response body:",
        $result->getBody(),
      ]));
    }

    $this->info('Bot commands on DiscordBotList updated successfully');

    return 0;
  }
}
