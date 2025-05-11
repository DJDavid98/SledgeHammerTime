<?php

namespace App\Enums;

enum SettingNames: string {
  case BOLD_PREVIEW = "boldPreview";
  case COLUMNS = "columns";
  case DEFAULT_AT_HOUR = "defaultAtHour";
  case DEFAULT_AT_MINUTE = "defaultAtMinute";
  case DEFAULT_AT_SECOND = "defaultAtSecond";
  case EPHEMERAL = "ephemeral";
  case FORMAT = "format";
  case HEADER = "header";
  case TIMEZONE = "timezone";
  case FORMAT_MINIMAL_REPLY = "formatMinimalReply";
  case TELEMETRY = "telemetry";
}
