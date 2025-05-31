<?php

namespace App\Enums;

enum SettingNames: string {
  case COLUMNS = "columns";
  case EPHEMERAL = "ephemeral";
  case FORMAT = "format";
  case HEADER = "header";
  case TIMEZONE = "timezone";
  case BOLD_PREVIEW = "boldPreview";
  case FORMAT_MINIMAL_REPLY = "formatMinimalReply";
  case TELEMETRY = "telemetry";
  case DEFAULT_AT_HOUR = "defaultAtHour";
  case DEFAULT_AT_MINUTE = "defaultAtMinute";
  case DEFAULT_AT_SECOND = "defaultAtSecond";
}
