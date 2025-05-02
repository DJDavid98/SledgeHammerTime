<?php

namespace App\Enums;

enum DiscordBotCommandOptionType: int {
  case SUB_COMMAND = 1;
  case SUB_COMMAND_GROUP = 2;
  case STRING = 3;
  case INTEGER = 4;
  case BOOLEAN = 5;
  case USER = 6;
  case CHANNEL = 7;
  case ROLE = 8;
  case MENTIONABLE = 9;
  case NUMBER = 10;
  case ATTACHMENT = 11;
}
