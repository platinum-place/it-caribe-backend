<?php

namespace Root\ZohoApi\Infrastructure\Persistence\Repositories;

use Root\ZohoApi\Domain\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthClientRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Root\ZohoApi\Domain\Entities\ZohoOauthAccessTokenEntity;
use Root\ZohoApi\Domain\Entities\ZohoOauthClientEntity;
use Root\ZohoApi\Domain\Entities\ZohoOauthRefreshTokenEntity;
use Root\ZohoApi\Domain\ValueObjects\AccessToken;
use Root\ZohoApi\Infrastructure\Persistence\Models\ZohoOauthAccessToken;
use Root\ZohoApi\Infrastructure\Persistence\Models\ZohoOauthClient;
use Root\ZohoApi\Infrastructure\Persistence\Models\ZohoOauthRefreshToken;

class ZohoOauthAccessTokenEloquentRepository implements ZohoOauthAccessTokenRepositoryInterface
{
    public function store(AccessToken $accessToken): ZohoOauthAccessTokenEntity
    {
        $record = ZohoOauthAccessToken::create([
            'access_token' => $accessToken->accessToken,
            'api_domain' => $accessToken->apiDomain,
            'token_type' => $accessToken->tokenType,
            'expires_in' => $accessToken->expiresIn,
            'scope' => $accessToken->scope,
        ]);

        return new ZohoOauthAccessTokenEntity(
            $record->id,
            $record->access_token,
            $record->api_domain,
            $record->token_type,
            $record->expires_in,
            $record->expires_at,
            $record->scope,
        );
    }
}
