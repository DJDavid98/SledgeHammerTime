<?php

namespace App\Console\Commands;

use App\Models\BotShard;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateDiscordBotListStatistics extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'app:update-dbl-stats';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update bot statistics on the DiscordBotList tracking service';

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

    $statsData = [
      'guilds' => (int)BotShard::sum('server_count'),
    ];
    $this->info("Updating DiscordBotList bot stats…\n".var_export($statsData, return: true));

    $endpoint = sprintf("/bots/%s/stats", config('services.discord-bot-list.bot_id'));
    $result = Http::asJson()
      ->baseUrl(config('services.discord-bot-list.base_url'))
      ->withHeaders([
        'Authorization' => $token,
      ])
      ->post($endpoint, $statsData);

    $statusCode = $result->getStatusCode();
    if ($statusCode !== 200){
      $this->fail(implode("\n", [
        "Failed to update bot stats on DiscordBotList, got HTTP $statusCode",
        "Response headers:",
        var_export($result->getHeaders(), return: true),
        "Response body:",
        $result->getBody(),
      ]));
    }

    $this->info('Bot stats on DiscordBotList updated successfully');

    return 0;
  }
}
