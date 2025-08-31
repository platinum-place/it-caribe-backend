<?php

namespace Root\ZohoApi\Infrastructure\Persistence\Repositories;

use Root\ZohoApi\Domain\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Root\ZohoApi\Domain\Entities\ZohoOauthRefreshTokenEntity;
use Root\ZohoApi\Infrastructure\Persistence\Models\ZohoOauthRefreshToken;

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
