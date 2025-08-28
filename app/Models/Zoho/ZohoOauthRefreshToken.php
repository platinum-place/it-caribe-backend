<?php

namespace App\Models\Zoho;

use App\Observers\Zoho\ZohoOauthAccessTokenObserver;
use App\Observers\Zoho\ZohoOauthRefreshTokenObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([ZohoOauthRefreshTokenObserver::class])]
class ZohoOauthRefreshToken extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'refresh_token', 'api_domain', 'token_type',
        'created_by', 'updated_by', 'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
        ];
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'deleted_by');
    }
}
