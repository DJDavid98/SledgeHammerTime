<?php

return [
  'howTo' => 'Pick a date, copy the desired timestamp from the :syntaxColName column, then paste it anywhere in a chat message. The result will be a dynamic timestamp that displays differently for everyone based on their own timezone.',
  'picker' => [
    'label' => [
      'date' => 'Date',
      'time' => 'Time',
      'dateAndTime' => 'Date and time',
      'timezone' => 'Timezone',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Set to current time',
      'lock' => 'Lock timestamp via URL',
      'unlock' => 'Unlock timestamp',
      'previousYear' => 'Previous year',
      'previousMonth' => 'Previous month',
      'previousDecade' => 'Previous decade',
      'nextMonth' => 'Next month',
      'nextYear' => 'Next year',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Chat syntax',
    'resultColumn' => 'Example result',
    'editFormats' => 'Customize formats',
    'resetFormats' => 'Reset to defaults',
    'hideFormat' => 'Hide this format',
    'showFormat' => 'Show this format',
    'unhideInProfile' => 'Unhide in profile settings',
  ],
  'faq' => [
    'title' => 'Frequently Asked Questions',
    'description' => 'This section is English-only for now, and it\'s heavily based on content from <1>our Discord server</1>. Some links might not work as expected unless you are a member.',
  ],
  'usefulLinks' => [
    'lead' => 'You may also find these useful:',
    'server' => [
      'header' => 'Official HammerTime Server',
      'p' => 'Discuss the website, test the syntax and suggest features',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Generate timestamps from within Discord using slash commands',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Rebane\'s <1>Colored</1> Text Generator',
      'p' => 'A simple app that creates colored Discord messages using ANSI color codes',
    ],
    "subreddit" => [
      "p" => "The community hosting weekly challenges for an underrated racing game that inspired the creation of this project",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
      'discordTimestampGenerator' => [
        'p' => 'Simple, fast Discord timestamp generator with instant preview and all format options',
],
    ],
  ],
];
