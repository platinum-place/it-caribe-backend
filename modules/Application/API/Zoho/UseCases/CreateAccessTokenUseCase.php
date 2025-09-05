<?php

namespace Modules\Application\API\Zoho\UseCases;

use Modules\Domain\API\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Entities\ZohoOauthAccessTokenEntity;

class CreateAccessTokenUseCase
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ZohoCRMInterface $zohoCRM,
        protected ZohoOauthRefreshTokenRepositoryInterface $oauthRefreshTokenRepository,
        protected ZohoOauthAccessTokenRepositoryInterface $oauthAccessTokenRepository,
    ) {
        //
    }

    public function handle(): ZohoOauthAccessTokenEntity
    {
        $oauthRefreshToken = $this->oauthRefreshTokenRepository->fetchMostRecent();

        $response = $this->zohoCRM->fetchAccessToken($oauthRefreshToken->refreshToken);

        return $this->oauthAccessTokenRepository->store(
            $response['access_token'],
            $response['api_domain'],
            $response['token_type'],
            $response['expires_in'],
            $response['scope'],
        );
    }
}
