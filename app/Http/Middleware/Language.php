<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Teto\HTTP\AcceptLanguage;

class Language {
  public function handle(Request $request, Closure $next) {
    $languages = Config::get('languages');
    $first_route_segment = $request->segment(1);
    if ($first_route_segment === 'discord'){
      return $next($request);
    }

    if (array_key_exists($first_route_segment, $languages)){
      $app_locale_key = $first_route_segment;
      App::setLocale($languages[$first_route_segment]);
    }
    else {
      $default_lang = config('app.fallback_locale');
      $app_locale_key = $default_lang;
      $accepts_list = AcceptLanguage::get();
      foreach ($accepts_list as $accepts){
        $languageKey = $accepts['language'].($accepts['region'] ? "-{$accepts['region']}" : '');
        if (!array_key_exists($languageKey, $languages)){
          continue;
        }

        $app_locale_key = $languageKey;
        $default_lang = $languages[$languageKey];
        break;
      }
      App::setLocale($languages[$default_lang]);
    }
    if ($first_route_segment !== $app_locale_key && $request->method() === 'GET'){
      $query = $request->query->all();
      $query_string = !empty($query) ? '?'.http_build_query($query) : '';

      return redirect("/$app_locale_key/{$request->path()}$query_string");
    }

    return $next($request);
  }
}
