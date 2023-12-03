<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller {
  function index(Request $request) {
    return Inertia::render('TimestampPicker', [
      'defaultTs' => (int)$request->query('t'),
      'defaultTimezone' => $request->query('tz'),
    ]);
  }

  function discord() {
    $inviteUrl = env('DISCORD_INVITE_URL');
    if (empty($inviteUrl)){
      throw new NotFoundHttpException();
    }

    return redirect($inviteUrl);
  }
}
