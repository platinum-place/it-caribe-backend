<?php

namespace App\UseCases;

use App\Contracts\ZohoCRMInterface;
use App\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use App\Contracts\ZohoOauthClientRepositoryInterface;
use App\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use App\Entities\ZohoOauthAccessTokenEntity;
use App\ValueObjects\OauthClient;

class CreateAccessTokenUseCase
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

    public function handle(): ZohoOauthAccessTokenEntity
    {
        $oauthClient = $this->oauthClientRepository->findLast();

        $oauthRefreshToken = $this->oauthRefreshTokenRepository->findLast();

        $response = $this->zohoCRM->fetchAccessToken(
            $oauthRefreshToken->refreshToken,
            new OauthClient(
                $oauthClient->clientId,
                $oauthClient->clientSecret
            )
        );

        return $this->oauthAccessTokenRepository->store($response);
    }
}
