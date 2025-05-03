<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;

class BotShard extends Model {
  use HasUiInfo;

  protected $fillable = [
    'id',
    'server_count',
    'member_count',
    'started_at',
    'updated_at',
  ];

  public function mapToUiInfo():array {
    return [
      'id' => $this->id,
      'serverCount' => $this->server_count,
      'memberCount' => $this->member_count,
      'startedAt' => $this->started_at,
      'createdAt' => $this->created_at,
      'updatedAt' => $this->updated_at,
    ];
  }
}
