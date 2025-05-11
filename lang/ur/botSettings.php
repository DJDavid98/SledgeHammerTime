<?php

return [
  'title' => 'App Settings',
  'description' => 'Below you can see your current settings in the HammerTime App for each connected account.',
  'learnMore' => 'Not sure what the app is or curious about what it can do? Visit the <1>Discord App</1> link to learn more.',
  'advancedSettings' => [
    'toggleText' => 'Advanced settings',
    'atCommandName' => 'at',
    'hourOptionName' => 'hour',
    'minuteOptionName' => 'minute',
    'secondOptionName' => 'second',
  ],
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
    'formatMinimalReply' => [
      'displayName' => 'Minimal reply when using format option',
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
    'boldPreview' => [
      'displayName' => 'Format preview as bold',
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
    'telemetry' => [
      'displayName' => 'Allow Telemetry collection',
      'explanation' => 'This is entirely optional and has no effect your ability to use the bot. See the <1/> page for details.',
    ],
  ],
  'saveSuccess' => 'Your settings have been saved successfully.',
];
