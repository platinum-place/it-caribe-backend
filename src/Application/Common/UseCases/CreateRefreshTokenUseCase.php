<?php

namespace Modules\Application\Common\UseCases;

use Modules\Domain\Common\Contracts\ZohoCRMInterface;
use Modules\Domain\Common\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Common\Repositories\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\Common\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Domain\Common\Repositories\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Domain\Common\ValueObjects\OauthClient;

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
