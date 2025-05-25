<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller {
  function index() {
    return Inertia::render('Picker/TimestampPicker');
  }

  function discord() {
    $inviteUrl = env('DISCORD_INVITE_URL');
    if (empty($inviteUrl)){
      throw new NotFoundHttpException();
    }

    return redirect($inviteUrl);
  }
}
