<?php

namespace Modules\Application\Zoho\UseCases;

use Modules\Domain\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\Zoho\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Zoho\Repositories\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\Zoho\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Domain\Zoho\Repositories\ZohoOauthRefreshTokenRepositoryInterface;

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

        $response = $this->zohoCRM->fetchAccessToken($oauthRefreshToken->refreshToken, $oauthClient->clientId, $oauthClient->clientSecret);

        return $this->oauthAccessTokenRepository->store($response);
    }
}
