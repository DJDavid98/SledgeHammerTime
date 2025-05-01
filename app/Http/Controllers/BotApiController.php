<?php

namespace App\Http\Controllers;

use App\Http\Requests\BotLoginRequest;
use App\Http\Requests\SaveShardStatsRequest;
use App\Http\Requests\UpdateBotCommandsRequest;
use App\Models\BotCommand;
use App\Models\BotShard;
use App\Models\DiscordUser;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BotApiController extends Controller {
  function user(Request $request) {
    /** @var User|null $user */
    $user = $request->user();

    return response()->json($user?->mapToUiInfo());
  }

  function loginLink(BotLoginRequest $request) {
    $data = $request->validated();

    $expiresAt = now()->addMinutes(5);
    $loginUrl = URL::temporarySignedRoute(
      'botLogin',
      $expiresAt,
      array_merge([
        'discordUserId' => $request->route('discordUserId'),
        'locale' => $request->route('locale'),
      ], $data),
    );

    return response()->json(['loginUrl' => $loginUrl, 'expiresAt' => $expiresAt->unix()]);
  }

  function settings(Request $request) {
    $discordUserId = $request->route('discordUserId');
    /**
     * @var DiscordUser $discordUser
     */
    $discordUser = DiscordUser::find($discordUserId);
    $settings = $discordUser?->getSettingsRecord() ?? [];
    $mergedSettings = Settings::mergeWithDefaults($settings);

    return response()->json($mergedSettings);
  }

  function getShardStats() {
    return response()->json(BotShard::all());
  }

  function updateShardStats(SaveShardStatsRequest $request) {
    $requestData = $request->validated();

    $shard = BotShard::updateOrCreate([
      'id' => $requestData['id'],
    ], [
      'id' => $requestData['id'],
      'server_count' => $requestData['server_count'],
      'member_count' => $requestData['member_count'],
      'started_at' => $requestData['started_at'],
    ]);

    return response()->json($shard);
  }

  function updateBotCommands(UpdateBotCommandsRequest $request) {
    $requestData = $request->validated();

    $commands = [];
    foreach ($requestData as $commandData){
      $command = BotCommand::updateOrCreate([
        'name' => $commandData['name'],
      ], [
        'id' => $commandData['id'],
        'name' => $commandData['name'],
        'description' => $commandData['description'],
        'type' => $commandData['type'],
      ]);
      $commands[] = $command;
    }

    return response()->json($commands);
  }
}
