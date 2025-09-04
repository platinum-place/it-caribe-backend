<?php

namespace Modules\Application\Zoho\UseCases;

use Modules\Domain\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\Zoho\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Zoho\Repositories\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\Zoho\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Domain\Zoho\Repositories\ZohoOauthRefreshTokenRepositoryInterface;

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

        $response = $this->zohoCRM->fetchRefreshToken($code, $oauthClient->clientId, $oauthClient->clientSecret, $oauthClient->redirectUri);

        $this->oauthRefreshTokenRepository->store($response->refreshToken);

        return $this->oauthAccessTokenRepository->store($response->accessToken);
    }
}
