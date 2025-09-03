<?php

namespace Modules\Infrastructure\Common\Persistence\Repositories;

use Modules\Domain\Common\Entities\ZohoOauthRefreshTokenEntity;
use Modules\Domain\Common\Repositories\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Infrastructure\Common\Persistence\Models\ZohoOauthRefreshToken;

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

    public function findLast(): ZohoOauthRefreshTokenEntity
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
