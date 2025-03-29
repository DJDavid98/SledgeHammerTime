<?php

namespace App\Http\Controllers;

use App\Enums\DiscordTimestampFormat;
use App\Enums\TimestampMessageColumns;
use App\Http\Requests\BotSettingsUpdate;
use App\Models\DiscordUser;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BotSettingsController extends Controller {
  function edit() {
    $userSettings = Auth::user()?->discordUsers()->get()->map(fn(DiscordUser $du) => [
      'user' => $du->mapToUiInfo(),
      'settings' => $du->getSettingsRecord(),
    ]);

    return Inertia::render('Settings/BotSettings', [
      'userSettings' => $userSettings ?? [],
      'defaultSettings' => Settings::mergeWithDefaults([]),
      'formatOptions' => array_map(static fn($x) => $x->value, DiscordTimestampFormat::cases()),
      'columnsOptions' => array_map(static fn($x) => $x->value, TimestampMessageColumns::cases()),
    ]);
  }

  function set(BotSettingsUpdate $request) {
    $data = $request->validated();

    $discordUserId = $request->route('discordUserId');
    $discordUser = DiscordUser::findOrFail($discordUserId);

    /** @var Settings[] $currentSettings */
    $currentSettings = $discordUser->settings()->get();
    DB::transaction(function () use ($discordUser, $data, $currentSettings) {
      foreach ($currentSettings as $setting){
        $shouldDelete = !isset($data[$setting->setting]);
        /** @var Settings $setting */
        if (!$shouldDelete && Settings::shouldDeleteIfMatchingDefault($setting->setting, $data[$setting->setting])){
          $shouldDelete = true;
          unset($data[$setting->setting]);
        }
        if ($shouldDelete){
          $setting->delete();
        }
        else {
          $setting->value = $data[$setting->setting];
          $setting->save();
        }
        unset($data[$setting->setting]);
      }

      $newSettingData = [];
      foreach ($data as $settingName => $value){
        if (Settings::shouldDeleteIfMatchingDefault($settingName, $value))
          continue;
        $newSettingData[] = ['setting' => $settingName, 'value' => $value];
      }
      $discordUser->settings()->createMany($newSettingData);
    });

    $discordUser->clearSettingsCache();

    return response()->noContent(200);
  }
}
