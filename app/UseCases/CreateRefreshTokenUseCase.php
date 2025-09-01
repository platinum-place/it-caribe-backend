<?php

namespace App\UseCases;

use App\Contracts\ZohoCRMInterface;
use App\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use App\Contracts\ZohoOauthClientRepositoryInterface;
use App\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use App\Entities\ZohoOauthAccessTokenEntity;
use App\ValueObjects\OauthClient;

class CreateRefreshTokenUseCase
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ZohoCRMInterface $zohoCRM,
        protected ZohoOauthClientRepositoryInterface $oauthClientRepository,
        protected ZohoOauthRefreshTokenRepositoryInterface $oauthRefreshTokenRepository,
        protected ZohoOauthAccessTokenRepositoryInterface $oauthAccessTokenRepository,
    ) {
        //
    }

    public function handle(string $code): ZohoOauthAccessTokenEntity
    {
        $oauthClient = $this->oauthClientRepository->findLast();

        $response = $this->zohoCRM->fetchRefreshToken(
            $code,
            new OauthClient(
                $oauthClient->clientId,
                $oauthClient->clientSecret,
                $oauthClient->redirectUri
            )
        );

        $this->oauthRefreshTokenRepository->store($response->refreshToken);

        return $this->oauthAccessTokenRepository->store($response->accessToken);
    }
}
