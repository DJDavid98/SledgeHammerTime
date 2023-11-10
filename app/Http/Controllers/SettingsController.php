<?php

namespace App\Http\Controllers;

use App\Models\DiscordUser;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SettingsController extends Controller
{
    function edit()
    {
        $userSettings = Auth::user()?->discordUsers()->get()->map(fn(DiscordUser $du) => [
            'user' => $du->mapToUiInfo(),
            'setting'
        ]);
        return Inertia::render('Settings', [
            'userSettings' => $userSettings,
        ]);
    }
}
