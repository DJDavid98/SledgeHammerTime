<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundController extends Controller {
  public function notFound() {
    throw new NotFoundHttpException();
  }
}
