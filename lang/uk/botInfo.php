<?php

return [
  'heading' => 'Discord App',
  'description' => 'The HammerTime App lets you obtain easy-to-copy timestamp codes from within the Discord user interface using slash and context menu commands.',
  'customizeSettings' => 'Some of its functionality can also be customized by logging in, then visiting the <1>Bot Settings</1> page (also available by clicking your username in the sidebar).',
  'addBotLead' => 'Add the bot to your server or your account and use it whenever you need a timestamp but don\'t feel like opening the browser.',
  'commandsReference' => [
    'title' => 'Commands Reference',
    'description' => 'Below you will find a list of all commands and their options for your reference. This page currently shows the same descriptions that you would see in Discord as you are running the command, but it might be extended with additional information and examples later on.',
    'commandType' => [
      1 => 'slash command',
      2 => 'user context menu command',
      3 => 'message context menu command',
    ],
    'commandDescription' => 'Description',
    'commandOptions' => 'Options',
    'additionalDescription' => [
      'commands' => [
        'Message Sent' => 'Provides the timestamp syntax for the time when a message was sent',
        'Message Last Edited' => 'Provides the timestamp syntax for the time when a message was last edited',
        'Extract Timestamps' => 'Provides a list of all dynamic timestamps found in a specific message',
      ],
    ],
  ],
];
