<?php

namespace Modules\Infrastructure\Common\Persistence\Repositories;

use Modules\Domain\Common\Entities\ZohoOauthRefreshTokenEntity;
use Modules\Domain\Common\Repositories\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Infrastructure\Common\Persistence\Models\ZohoOauthRefreshToken;

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
