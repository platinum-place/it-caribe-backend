<?php

namespace Root\ZohoApi\Application\UseCases;

use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;

class CreateRefreshTokenUseCase
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoCRMInterface $zohoCRM)
    {
        //
    }

    public function handle(string $code)
    {

        $response = $this->zohoCRM->fetchRefreshToken($code);

        //        ZohoOauthRefreshToken::create([
        //            'refresh_token' => $response->refreshToken,
        //            'api_domain' => $response->apiDomain,
        //            'token_type' => $response->tokenType,
        //        ]);
    }
}
