<?php

return [
  'title' => 'Bot-instellingen',
  'description' => 'Hieronder ziet u uw huidige instellingen in de HammerTime Bot voor elke verbonden account.',
  'fields' => [
    'rawData' => [
      'displayName' => 'Ruwe gegevens (voor debugging-doeleinden)',
    ],
    'timezone' => [
      'displayName' => 'Tijdzone',
    ],
    'format' => [
      'displayName' => 'Format',
      'option' => [
        'd' => 'Korte datum',
        'f' => 'Datum en tijd',
        't' => 'Korte tijd',
        'D' => 'Lange datum',
        'F' => 'Weekdag, datum en tijd',
        'R' => 'Relatief',
        'T' => 'Lange tijd',
        'default' => 'Standaard',
      ],
    ],
    'columns' => [
      'displayName' => 'Kolommen',
      'option' => [
        'syntax' => 'Syntax only',
        'preview' => 'Preview only',
        'both' => 'Both syntax and preview',
        'default' => 'Standaard',
      ],
    ],
    'ephemeral' => [
      'displayName' => 'Ephemeral',
    ],
    'header' => [
      'displayName' => 'Koptekst',
    ],
  ],
  'saveSuccess' => 'Uw instellingen zijn succesvol opgeslagen.',
];
