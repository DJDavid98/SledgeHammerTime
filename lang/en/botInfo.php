<?php

return [
  'heading' => 'Discord App',
  'description' => 'The HammerTime App lets you obtain easy-to-copy timestamp codes from within the Discord user interface using slash and context menu commands.',
  'customizeSettingsGuest' => 'Some of its functionality can also be customized by <1>logging in</1>, then visiting the <3>App Settings</3> page (also available by clicking your username in the sidebar).',
  'customizeSettingsAuthenticated' => 'Some of its functionality can also be customized by visiting the <1>App Settings</1> page (also available by clicking your username in the sidebar).',
  'addAppLead' => 'Add the app to your server or your account and use it whenever you need a timestamp but don\'t feel like opening the browser.',
  'shareableLink' => 'You can also share the link below with others which will let them add the app without any additional distractions:',
  'shardStats' => [
    'title' => 'Shard Statistics',
    'description' => 'After an app reaches a certain number of servers where it is installed, Discord requires apps to use sharding, which essentially means splitting up the handling of interactions between multiple processes. Below you can see some basic information about each shard recently used by the app.',
    'shardId' => 'Shard ID',
    'serverCount' => 'Connected Servers',
    'startupTime' => 'Startup Time',
    'lastUpdateTime' => 'Last Updated',
  ],
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
