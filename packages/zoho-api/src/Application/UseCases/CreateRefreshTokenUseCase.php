<?php

namespace Root\ZohoApi\Application\UseCases;

use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthClientRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Root\ZohoApi\Domain\Entities\ZohoOauthAccessTokenEntity;

class CreateRefreshTokenUseCase
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ZohoCRMInterface                         $zohoCRM,
        protected ZohoOauthClientRepositoryInterface       $oauthClientRepository,
        protected ZohoOauthRefreshTokenRepositoryInterface $oauthRefreshTokenRepository,
        protected ZohoOauthAccessTokenRepositoryInterface  $oauthAccessTokenRepository,
    )
    {
        //
    }

    public function handle(string $code): ZohoOauthAccessTokenEntity
    {
        $client = $this->oauthClientRepository->findLast();

        $response = $this->zohoCRM->fetchRefreshToken($code, $client->clientId, $client->clientSecret, $client->redirectUri);

        $this->oauthRefreshTokenRepository->store($response->refreshToken);

        return $this->oauthAccessTokenRepository->store($response->accessToken);
    }
}
