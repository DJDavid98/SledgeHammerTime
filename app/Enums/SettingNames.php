<?php

namespace App\Enums;

enum SettingNames: string {
  case FORMAT = "format";
  case COLUMNS = "columns";
  case EPHEMERAL = "ephemeral";
  case HEADER = "header";
  case TIMEZONE = "timezone";
  case DEFAULT_AT_HOUR = "defaultAtHour";
  case DEFAULT_AT_MINUTE = "defaultAtMinute";
  case DEFAULT_AT_SECOND = "defaultAtSecond";
}
