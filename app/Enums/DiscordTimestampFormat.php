<?php

namespace App\Enums;

enum DiscordTimestampFormat: string {
  case DEFAULT = 'default';
  case SHORT_DATE = 'd';
  case SHORT_FULL = 'f';
  case SHORT_TIME = 't';
  case LONG_DATE = 'D';
  case LONG_FULL = 'F';
  case RELATIVE = 'R';
  case LONG_TIME = 'T';
}
