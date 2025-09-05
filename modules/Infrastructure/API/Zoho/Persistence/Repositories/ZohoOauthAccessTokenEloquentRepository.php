<?php

namespace Modules\Infrastructure\API\Zoho\Persistence\Repositories;

use Modules\Domain\API\Zoho\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Entities\ZohoOauthAccessTokenEntity;
use Modules\Infrastructure\API\Zoho\Persistence\Models\ZohoOauthAccessToken;

class ZohoOauthAccessTokenEloquentRepository implements ZohoOauthAccessTokenRepositoryInterface
{
    public function store(string $accessToken, string $apiDomain, string $tokenType, int $expiresIn, ?string $scope = null): ZohoOauthAccessTokenEntity
    {
        return $this->returnEntity(
            ZohoOauthAccessToken::create([
                'access_token' => $accessToken,
                'api_domain' => $apiDomain,
                'token_type' => $tokenType,
                'expires_in' => $expiresIn,
                'expires_at' => now()->addSeconds($expiresIn),
                'scope' => $scope,
            ])
        );
    }

    public function fetchMostRecent(): ZohoOauthAccessTokenEntity
    {
        return $this->returnEntity(
            ZohoOauthAccessToken::query()
                ->where('expires_at', '>=', now())
                ->firstOrFail()
        );
    }

    protected function returnEntity(ZohoOauthAccessToken $record): ZohoOauthAccessTokenEntity
    {
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
