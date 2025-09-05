<?php

namespace Modules\Infrastructure\API\Zoho\Persistence\Repositories;

use Modules\Domain\API\Zoho\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Entities\ZohoOauthRefreshTokenEntity;
use Modules\Infrastructure\API\Zoho\Persistence\Models\ZohoOauthRefreshToken;

class ZohoOauthRefreshTokenEloquentRepository implements ZohoOauthRefreshTokenRepositoryInterface
{
    public function store(string $refreshToken): ZohoOauthRefreshTokenEntity
    {
        return $this->returnEntity(
            ZohoOauthRefreshToken::create([
                'refresh_token' => $refreshToken,
            ])
        );
    }

    public function fetchMostRecent(): ZohoOauthRefreshTokenEntity
    {
        return $this->returnEntity(
            ZohoOauthRefreshToken::query()->latest('created_at')->firstOrFail()
        );
    }

    protected function returnEntity(ZohoOauthRefreshToken $record): ZohoOauthRefreshTokenEntity
    {
        return new ZohoOauthRefreshTokenEntity(
            $record->id,
            $record->refresh_token,
        );
    }
}
