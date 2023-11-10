<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiscordUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'display_name',
        'discriminator',
        'avatar',
        'access_token',
        'refresh_token',
        'scopes',
        'token_expires',
        'user_id',
    ];

    protected $casts = [
        // Since this is a bigint JS might lose precision if it's left as number
        'id' => 'string',
    ];

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function getPublicNameAttribute(): string
    {
        return $this->display_name ?? ($this->discriminator !== '0' ? "{$this->name}#{$this->discriminator}" : $this->name);
    }

    function mapToUiInfo()
    {
        return [
            'id' => $this->id,
            'name' => $this->public_name,
            'avatar' => $this->avatar,
            'discriminator' => $this->discriminator,
        ];
    }
}
