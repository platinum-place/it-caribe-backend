<?php

namespace Modules\Application\Common\UseCases;

use Modules\Domain\Common\Contracts\ZohoCRMInterface;
use Modules\Domain\Common\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Common\Repositories\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\Common\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Domain\Common\Repositories\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Domain\Common\ValueObjects\OauthClient;

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
