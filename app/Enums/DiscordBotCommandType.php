<?php

namespace App\Enums;

enum DiscordBotCommandType: int {
  /**
   * Slash commands
   */
  case ChatInput = 1;
  /**
   * User right-click menu
   */
  case User = 2;
  /**
   * Message right-click menu
   */
  case Message = 3;
  /**
   * App Activity related, unused
   *
   * @deprecated
   */
  case PrimaryEntryPoint = 4;
}
