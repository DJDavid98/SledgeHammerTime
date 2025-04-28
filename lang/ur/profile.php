<?php

return [
  'title' => 'Profile',
  'information' => [
    'heading' => 'Profile Information',
    'description' => "Update your account's profile information.",
    'displayName' => 'Display Name',
    'saveSuccess' => 'Your profile has been updated successfully.',
  ],
  'accounts' => [
    'heading' => 'Connected Accounts',
    'description' => [
      'A HammerTime account is going to let you link multiple Discord accounts to be able to manage their resources in one place in the future.',
      'Below you can find a list of all Discord accounts associated with this HammerTime account.',
    ],
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Link or Update Account',
      'description' => 'By linking multiple Discord accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place. If your profile picture or display name changed, you can also use this to update that information for any account which is already linked.',
      'authorize' => 'Authorize Discord account',
    ],
  ],
  'deletion' => [
    'heading' => 'Account Deletion',
    'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'deleteButton' => 'Delete Account',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
