<?php

namespace App\Enums;

enum SettingNames: string {
  case FORMAT = "format";
  case COLUMNS = "columns";
  case EPHEMERAL = "ephemeral";
  case HEADER = "header";
  case TIMEZONE = "timezone";
}
