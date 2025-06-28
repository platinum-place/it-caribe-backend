<?php

namespace App\Models\Zoho;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ZohoOauthRefreshToken extends Model
{
    use softDeletes;

    protected $fillable = [
        'refresh_token',
    ];
}
