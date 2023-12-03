<?php

namespace App\Http\Controllers;

use App\Models\DiscordUser;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BotSettingsController extends Controller {
  function edit() {
    $userSettings = Auth::user()?->discordUsers()->get()->map(fn(DiscordUser $du) => [
      'user' => $du->mapToUiInfo(),
      'settings' => $du->settings()->get()->reduce(fn(array $acc, Settings $s) => array_merge($acc, [$s->setting => json_decode($s->value)]), []),
    ]);

    return Inertia::render('BotSettings', [
      'userSettings' => $userSettings,
    ]);
  }
}
