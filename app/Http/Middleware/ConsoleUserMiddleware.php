<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsoleUserMiddleware {
  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    $expectedUserId = config('app.console_user_uuid');
    if (empty($expectedUserId)){
      return response()->json(['message' => "Console user UUID is missing in .env file, run `php artisan bot-token:generate`"], 500);
    }

    $user = $request->user();
    if (empty($user) || $user->id !== $expectedUserId){
      return response()->json(['message' => "User ID {$user->id} not authorized (must be $expectedUserId)."], 401);
    }

    return $next($request);
  }
}
