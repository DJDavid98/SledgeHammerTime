<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RedirectController extends Controller {
  function discord() {
    $inviteUrl = env('DISCORD_INVITE_URL');
    if (empty($inviteUrl)){
      throw new NotFoundHttpException();
    }

    return redirect($inviteUrl);
  }

  function addBotLink(Request $request) {
    $install_type = $request->route('installType');
    $client_id = config('services.discord.client_id');
    switch ($install_type){
      case 'user':
        return redirect("https://discord.com/oauth2/authorize?client_id=$client_id&permissions=0&scope=applications.commands&integration_type=1");
      case 'guild':
        return redirect("https://discord.com/oauth2/authorize?client_id=$client_id&permissions=0&scope=bot%20applications.commands&integration_type=0");
      default:
        return response(status: 404);
    }
  }
}
