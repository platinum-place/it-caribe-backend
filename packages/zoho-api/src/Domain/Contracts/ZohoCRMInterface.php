<?php

namespace Root\ZohoApi\Domain\Contracts;

use Root\ZohoApi\Domain\ValueObjects\AccessToken;
use Root\ZohoApi\Domain\ValueObjects\AuthorizationCode;
use Root\ZohoApi\Domain\ValueObjects\RefreshToken;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken, string $clientId, string $clientSecret, string $redirectUri): AuthorizationCode;

    public function fetchAccessToken(string $refreshToken): AccessToken;
}
