<?php

namespace Root\ZohoApi\Application\UseCases;

use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthClientRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthRefreshTokenRepositoryInterface;

class CreateRefreshTokenUseCase
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ZohoCRMInterface $zohoCRM,
        protected ZohoOauthClientRepositoryInterface $oauthClientRepository,
        protected ZohoOauthRefreshTokenRepositoryInterface $oauthRefreshTokenRepository,
    )
    {
        //
    }

    public function handle(string $code)
    {
        $client = $this->oauthClientRepository->findLast();

        $response = $this->zohoCRM->fetchRefreshToken($code, $client->clientId, $client->clientSecret, $client->redirectUri);

        $this->oauthRefreshTokenRepository->store($response->refreshToken);


        //        ZohoOauthRefreshToken::create([
        //            'refresh_token' => $response->refreshToken,
        //            'api_domain' => $response->apiDomain,
        //            'token_type' => $response->tokenType,
        //        ]);
    }
}
