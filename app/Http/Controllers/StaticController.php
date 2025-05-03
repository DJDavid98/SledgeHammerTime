<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class StaticController extends Controller {
  public function addBot() {
    return Inertia::render('AddApp/TargetSelector');
  }

  public function design() {
    return Inertia::render('Design/DesignLanguage');
  }
}
