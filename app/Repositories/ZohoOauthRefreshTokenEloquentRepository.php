<?php

namespace App\Repositories;

use App\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use App\Entities\ZohoOauthRefreshTokenEntity;
use App\Models\ZohoOauthRefreshToken;

class ZohoOauthRefreshTokenEloquentRepository implements ZohoOauthRefreshTokenRepositoryInterface
{
    public function store(string $refreshToken): ZohoOauthRefreshTokenEntity
    {
        $record = ZohoOauthRefreshToken::create(['refresh_token' => $refreshToken]);

        return new ZohoOauthRefreshTokenEntity(
            $record->id,
            $record->refresh_token,
        );
    }

    public function findLast(): ZohoOauthRefreshTokenEntity
    {
        $record = ZohoOauthRefreshToken::query()->latest()->firstOrFail();

        return new ZohoOauthRefreshTokenEntity(
            $record->id,
            $record->refresh_token,
        );
    }
}
