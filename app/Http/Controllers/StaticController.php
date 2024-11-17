<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class StaticController extends Controller {
  public function design() {
    return Inertia::render('DesignLanguage');
  }
}
