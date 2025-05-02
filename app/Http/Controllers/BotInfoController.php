<?php

namespace App\Http\Controllers;

use App\Models\BotCommand;
use Inertia\Inertia;

class BotInfoController extends Controller {
  public function index() {
    return Inertia::render('BotInfo/BotInfo', [
      'commands' => BotCommand::with('options')->orderBy('type')->orderBy('name')->get(),
    ]);
  }
}
