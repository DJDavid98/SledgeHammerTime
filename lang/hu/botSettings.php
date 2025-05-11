<?php

return [
  'title' => 'App Beálítások',
  'description' => 'Alább láthatod a jelenlegi beállításaidat a HammerTime App-ban, minden összekapcsolt fiókodhoz.',
  'learnMore' => 'Nem tudod, mi ez az app, vagy kíváncsi vagy mit tud? Látogasd meg a <1>Discord App</1> linket további információért.',
  'advancedSettings' => [
    'toggleText' => 'Haladó beállítások',
    'atCommandName' => 'ekkor',
    'hourOptionName' => 'óra',
    'minuteOptionName' => 'perc',
    'secondOptionName' => 'másodperc',
  ],
  'fields' => [
    'rawData' => [
      'displayName' => 'Nyers adatok (hibakeresés céljából)',
    ],
    'timezone' => [
      'displayName' => 'Időzóna',
    ],
    'format' => [
      'displayName' => 'Formátum',
      'option' => [
        'd' => 'Rövid dátum',
        'f' => 'Dátum és idő',
        't' => 'Rövid idő',
        'D' => 'Hosszú dátum',
        'F' => 'Hét napja, dátum és idő',
        'R' => 'Viszonylagos',
        'T' => 'Hosszú idő',
        'default' => 'Alapértelmezett',
      ],
    ],
    'formatMinimalReply' => [
      'displayName' => 'Rövid válasz a formátum opció használatakor',
    ],
    'columns' => [
      'displayName' => 'Oszlopok',
      'option' => [
        'syntax' => 'Csak a kód',
        'preview' => 'Csak az előnézet',
        'both' => 'A kód és Az előnézet is',
        'default' => 'Alapértelmezett',
      ],
    ],
    'ephemeral' => [
      'displayName' => 'Ideiglenes',
    ],
    'header' => [
      'displayName' => 'Fejléc',
    ],
    'boldPreview' => [
      'displayName' => 'Előnézet formázása félkövéren',
    ],
    'defaultAtHour' => [
      'displayName' => 'Alapértelmezett ":hourOptionName" paraméter az /:atCommandName parancshoz',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Alapértelmezett ":minuteOptionName" paraméter az /:atCommandName parancshoz',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Alapértelmezett ":secondOptionName" paraméter az /:atCommandName parancshoz',
    ],
    'telemetry' => [
      'displayName' => 'Allow Telemetry collection',
      'explanation' => 'This is entirely optional and has no effect your ability to use the bot, see the <1/> page for details.',
    ],
  ],
  'saveSuccess' => 'A beállításaid sikeresen mentéstre kerültek.',
];
