<?php

return [
  'title' => 'App Settings',
  'description' => 'Below you can see your current settings in the HammerTime App for each connected account.',
  'learnMore' => 'Not sure what the app is or curious about what it can do? Visit the <1>Discord App</1> link to learn more.',
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
  ],
  'saveSuccess' => 'A beállításaid sikeresen mentéstre kerültek.',
];
