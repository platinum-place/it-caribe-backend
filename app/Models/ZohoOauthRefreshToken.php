<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZohoOauthRefreshToken extends Model
{
    use softDeletes;

    protected $fillable = [
        'refresh_token',
    ];
}
