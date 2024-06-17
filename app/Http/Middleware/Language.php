<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Teto\HTTP\AcceptLanguage;

class Language {
  protected array $ignored_segments = ['discord', 'bot-login'];

  public function handle(Request $request, Closure $next) {
    $languages = Config::get('languages');
    $first_route_segment = $request->segment(1);
    if (in_array($first_route_segment, $this->ignored_segments, true)){
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
        $language_key = $accepts['language'].($accepts['region'] ? "-{$accepts['region']}" : '');
        if (!array_key_exists($language_key, $languages)){
          continue;
        }

        $app_locale_key = $language_key;
        $default_lang = $languages[$language_key];
        break;
      }
      App::setLocale($default_lang);
    }
    if ($first_route_segment !== $app_locale_key && $request->method() === 'GET'){
      $query = $request->query->all();
      $query_string = !empty($query) ? '?'.http_build_query($query) : '';

      return redirect("/$app_locale_key/{$request->path()}$query_string");
    }

    return $next($request);
  }
}
