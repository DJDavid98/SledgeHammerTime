<?php

namespace App\Http\Controllers;

use App\Http\Requests\BotLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class BotApiController extends Controller {
  function user(Request $request) {
    return $request->user();
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
}
