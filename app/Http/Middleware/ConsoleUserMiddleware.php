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
    $envVarName = 'APP_CONSOLE_USER_UUID';
    $expectedUserId = env($envVarName);
    if (empty($expectedUserId)){
      return response()->json(['message' => "$envVarName env variable is not set, run `php artisan bot-token:generate`"], 500);
    }

    $user = $request->user();
    if (empty($user) || $user->id !== env('APP_CONSOLE_USER_UUID')){
      return response()->json(['message' => "User ID {$user->id} not authorized (must be $expectedUserId)."], 401);
    }

    return $next($request);
  }
}
