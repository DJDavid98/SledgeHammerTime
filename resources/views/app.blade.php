<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="theme-color" content="#5865F2" />
  <meta name="color-scheme" content="light dark" />

  <link rel="icon" href="/logos/logo.png" />

  <title inertia>{{ config('app.name', 'Laravel') }}</title>

  {{-- Fonts --}}
  @googlefonts

  {{-- Scripts --}}
  @routes
  @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
  @inertiaHead
</head>
<body class="no-anim">
@inertia
</body>
</html>
