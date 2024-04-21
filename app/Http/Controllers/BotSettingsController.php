<?php

namespace App\Http\Controllers;

use App\Enums\DiscordTimestampFormat;
use App\Enums\TimestampMessageColumns;
use App\Http\Requests\BotSettingsUpdate;
use App\Models\DiscordUser;
use App\Models\Settings;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;

class BotSettingsController extends Controller {
  function edit() {
    $userSettings = Auth::user()?->discordUsers()->get()->map(fn(DiscordUser $du) => [
      'user' => $du->mapToUiInfo(),
      'settings' => $du->settings()->get()->reduce(fn(array $acc, Settings $s) => array_merge($acc, [$s->setting => json_decode($s->value)]), []),
    ]);

    $availableTimezones = DateTimeZone::listIdentifiers();

    return Inertia::render('BotSettings', [
      'userSettings' => $userSettings,
      'availableTimezones' => $availableTimezones,
      'formatOptions' => array_map(static fn($x) => $x->value, DiscordTimestampFormat::cases()),
      'columnsOptions' => array_map(static fn($x) => $x->value, TimestampMessageColumns::cases()),
    ]);
  }

  function set(BotSettingsUpdate $request) {
    $data = $request->validated();

    $discordUserId = $request->route('discordUserId');
    $discordUser = DiscordUser::findOrFail($discordUserId);

    $currentSettings = $discordUser->settings()->get();
    DB::transaction(function () use ($discordUser, $data, $currentSettings) {
      foreach ($currentSettings as $setting){
        $shouldDelete = !isset($data[$setting->setting]);
        /** @var $setting Settings */
        if (!$shouldDelete && Settings::isDefaultValue($setting->setting, $data[$setting->setting])){
          $shouldDelete = true;
          unset($data[$setting->setting]);
        }
        if ($shouldDelete){
          $setting->delete();
        }
        else {
          $setting->value = json_encode($data[$setting->setting]);
          $setting->save();
        }
        unset($data[$setting->setting]);
      }

      $newSettingData = [];
      foreach ($data as $settingName => $value){
        if (Settings::isDefaultValue($settingName, $value))
          continue;
        $newSettingData[] = ['setting' => $settingName, 'value' => json_encode($value)];
      }
      $discordUser->settings()->createMany($newSettingData);
    });

    Redis::delete($discordUser->getSettingsCacheKey());

    return response()->noContent(200);
  }
}
