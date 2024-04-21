<?php

namespace App\Enums;

enum TimestampMessageColumns: string {
  case DEFAULT = 'default';
  case BOTH = 'both';
  case PREVIEW = 'preview';
  case SYNTAX = 'syntax';
}
