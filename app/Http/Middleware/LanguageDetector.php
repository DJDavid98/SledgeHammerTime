<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Teto\HTTP\AcceptLanguage;

class LanguageDetector {
  protected array $ignored_segments = ['discord', 'bot-login'];

  public function handle(Request $request, Closure $next) {
    $ui_locale_map = Config::get('languages.ui_locale_map');
    $first_route_segment = $request->segment(1);
    if (in_array($first_route_segment, $this->ignored_segments, true)){
      return $next($request);
    }

    $locale_route_alias = Config::get('languages.locale_route_alias');
    $request_path = $request->path();
    if (array_key_exists($first_route_segment, $locale_route_alias)){
      $request_path = substr($request_path, strlen("/$first_route_segment"));
      $app_locale_key = $locale_route_alias[$first_route_segment];
    }

    if (!isset($app_locale_key)){
      $default_lang = config('app.fallback_locale');
      $app_locale_key = $default_lang;
      if (array_key_exists($first_route_segment, $ui_locale_map)){
        $app_locale_key = $first_route_segment;
      }
      else {
        $accepts_list = AcceptLanguage::get();
        foreach ($accepts_list as $accepts){
          $language_key = $accepts['language'].($accepts['region'] ? "-{$accepts['region']}" : '');
          if (!array_key_exists($language_key, $ui_locale_map)){
            continue;
          }

          $app_locale_key = $language_key;
          break;
        }
      }
    }
    if ($first_route_segment !== $app_locale_key && $request->method() === 'GET'){
      $query = $request->query->all();
      $query_string = !empty($query) ? '?'.http_build_query($query) : '';

      return redirect("/$app_locale_key/$request_path$query_string");
    }
    App::setLocale($ui_locale_map[$app_locale_key]);

    return $next($request);
  }
}
