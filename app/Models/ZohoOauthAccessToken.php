<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZohoOauthAccessToken extends Model
{
    use softDeletes;

    protected $fillable = [
        'access_token', 'expires_at', 'revoked', 'scopes',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'revoked' => 'boolean',
    ];
}
