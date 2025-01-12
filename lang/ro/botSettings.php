<?php

return [
  'title' => 'Setări Bot',
  'description' => 'Mai jos puteți vedea setările curente din HammerTime Bot pentru fiecare cont conectat.',
  'fields' => [
    'rawData' => [
      'displayName' => 'Date brute (în scopuri de depanare)',
    ],
    'timezone' => [
      'displayName' => 'Fus orar',
    ],
    'format' => [
      'displayName' => 'Formatul',
      'option' => [
        'd' => 'Data scurtă',
        'f' => 'Data și timpu',
        't' => 'Timp scurt',
        'D' => 'Data lungă',
        'F' => 'Ziua săptămânii, data și ora',
        'R' => 'Relativ',
        'T' => 'Timp lung',
        'default' => 'Implicit',
      ],
    ],
    'columns' => [
      'displayName' => 'Coloane',
      'option' => [
        'syntax' => 'Numai sintaxa',
        'preview' => 'Doar previzualizare',
        'both' => 'Atât sintaxa, cât și previzualizarea',
        'default' => 'Implicit',
      ],
    ],
    'ephemeral' => [
      'displayName' => 'Efemer',
    ],
    'header' => [
      'displayName' => 'Antet',
    ],
  ],
  'saveSuccess' => 'Setările dvs. au fost salvate cu succes.',
];
