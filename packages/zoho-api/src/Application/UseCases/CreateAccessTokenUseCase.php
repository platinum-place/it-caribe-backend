<?php

namespace Root\ZohoApi\Application\UseCases;

use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthClientRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Root\ZohoApi\Domain\Entities\ZohoOauthAccessTokenEntity;
use Root\ZohoApi\Domain\ValueObjects\OauthClient;

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
