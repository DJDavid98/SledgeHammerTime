<?php

namespace App\Http\Controllers;

use App\Models\BotCommand;
use App\Models\BotCommandTranslation;
use App\Models\BotShard;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class BotInfoController extends Controller {
  public function index() {
    return Inertia::render('BotInfo/BotInfo', [
      'discordAppId' => config('services.discord.client_id'),
      'commands' => BotCommand::with(['options' => ['choices']])->orderBy('type')->orderBy('total_executions', 'desc')->orderBy('name')->get(),
      'translations' => BotCommandTranslation::where('locale', App::getLocale())->get()
        ->map(fn(BotCommandTranslation $t) => $t->mapToUiInfo()),
      'shards' => BotShard::orderBy('id')->get()->map(fn(BotShard $t) => $t->mapToUiInfo()),
    ]);
  }
}
