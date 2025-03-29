<?php

return [
  'title' => 'Bot Beállítások',
  'description' => 'Alább láthatod a jelenlegi beállításaidat a HammerTime Bot-ban, minden összekapcsolt fiókodhoz.',
  'advancedSettings' => [
    'toggleText' => 'Advanced settings',
    'atCommandName' => 'at',
    'hourOptionName' => 'hour',
    'minuteOptionName' => 'minute',
    'secondOptionName' => 'second',
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
    'defaultAtHour' => [
      'displayName' => 'Default ":hourOptionName" option for /:atCommandName command',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Default ":minuteOptionName" option for /:atCommandName command',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Default ":secondOptionName" option for /:atCommandName command',
    ],
  ],
  'saveSuccess' => 'A beállításaid sikeresen mentéstre kerültek.',
];
