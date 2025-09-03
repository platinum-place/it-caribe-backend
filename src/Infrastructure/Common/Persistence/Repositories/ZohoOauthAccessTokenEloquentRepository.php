<?php

namespace Modules\Infrastructure\Common\Persistence\Repositories;

use Modules\Domain\Common\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Common\Repositories\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\Common\ValueObjects\AccessToken;
use Modules\Infrastructure\Common\Persistence\Models\ZohoOauthAccessToken;

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
