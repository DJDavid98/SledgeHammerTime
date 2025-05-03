<?php

namespace App\Http\Controllers;

use App\Http\Requests\BotLoginRequest;
use App\Http\Requests\SaveShardStatsRequest;
use App\Http\Requests\UpdateBotCommandsRequest;
use App\Models\BotCommand;
use App\Models\BotCommandOption;
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
    $shard->touch();

    return response()->json($shard);
  }

  function updateBotCommands(UpdateBotCommandsRequest $request) {
    $requestData = $request->validated();

    $commands = [];
    foreach ($requestData as $commandData){
      /**
       * @var BotCommand $command
       */
      $command = BotCommand::updateOrCreate([
        'name' => $commandData['name'],
      ], [
        'id' => $commandData['id'],
        'name' => $commandData['name'],
        'description' => $commandData['description'],
        'type' => $commandData['type'],
      ]);
      if (!empty($commandData['name_localizations'])){
        foreach ($commandData['name_localizations'] as $locale => $value){
          $this->saveLocalizations(
            command: $command,
            locale: $locale,
            field: 'name',
            value: $value
          );
        }
      }
      if (!empty($commandData['description_localizations'])){
        foreach ($commandData['description_localizations'] as $locale => $value){
          $this->saveLocalizations(
            command: $command,
            locale: $locale,
            field: 'description',
            value: $value
          );
        }
      }
      if (!empty($commandData['options'])){
        foreach ($commandData['options'] as $order => $optionData){
          /**
           * @var BotCommandOption $option
           */
          $option = $command->options()->updateOrCreate([
            'name' => $optionData['name'],
          ], [
            'name' => $optionData['name'],
            'description' => $optionData['description'],
            'type' => $optionData['type'],
            'required' => $optionData['required'] ?? false,
            'order' => $order,
          ]);
          if (!empty($optionData['name_localizations'])){
            foreach ($optionData['name_localizations'] as $locale => $value){
              $this->saveLocalizations(
                command: $command,
                locale: $locale,
                field: 'name',
                value: $value,
                optionId: $option->id
              );
            }
          }
          if (!empty($optionData['description_localizations'])){
            foreach ($optionData['description_localizations'] as $locale => $value){
              $this->saveLocalizations(
                command: $command,
                locale: $locale,
                field: 'description',
                value: $value,
                optionId: $option->id
              );
            }
          }
        }
      }
      $commands[] = $command;
    }

    return response()->json($commands);
  }

  protected function saveLocalizations(BotCommand $command, string $locale, string $field, string $value, string $optionId = null):void {
    $queryBy = [
      'command_id' => $command->id,
      'option_id' => $optionId,
      'locale' => $locale,
      'field' => $field,
    ];
    $command->translations()->updateOrCreate($queryBy, array_merge(
      $queryBy,
      ['value' => $value]
    ));
  }
}
