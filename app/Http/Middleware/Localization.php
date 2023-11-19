<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Set app locale based on routing
        if (preg_match('~^([a-z]{2}(?:-[A-Z]{2})?)$~', $request->segment(1), $match)) {
            App::setLocale($match[0]);
            Session::put('locale', $match[0]);
        } else if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return $next($request);
    }
}
