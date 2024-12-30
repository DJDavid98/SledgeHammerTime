<?php

return [
  'title' => 'Bot Settings',
  'description' => 'Below you can see your current settings in the HammerTime Bot for each connected account.',
  'fields' => [
    'rawData' => [
      'displayName' => 'Raw data (for debugging purposes)',
    ],
    'timezone' => [
      'displayName' => 'Timezone',
    ],
    'format' => [
      'displayName' => 'Format',
      'option' => [
        'd' => 'Short date',
        'f' => 'Date and time',
        't' => 'Short time',
        'D' => 'Long date',
        'F' => 'Weekday, date and time',
        'R' => 'Relative',
        'T' => 'Long time',
        'default' => 'Default',
      ],
    ],
    'columns' => [
      'displayName' => 'Columns',
      'option' => [
        'syntax' => 'Syntax only',
        'preview' => 'Preview only',
        'both' => 'Both syntax and preview',
        'default' => 'Default',
      ],
    ],
    'ephemeral' => [
      'displayName' => 'Ephemeral',
    ],
    'header' => [
      'displayName' => 'Header',
    ],
  ],
];
