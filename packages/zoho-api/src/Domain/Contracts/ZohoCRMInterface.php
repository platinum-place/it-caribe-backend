<?php

namespace Root\ZohoApi\Domain\Contracts;

use Root\ZohoApi\Domain\ValueObjects\AccessToken;
use Root\ZohoApi\Domain\ValueObjects\AuthorizationCode;
use Root\ZohoApi\Domain\ValueObjects\OauthClient;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken, OauthClient $oauthClient): AuthorizationCode;

    public function fetchAccessToken(string $refreshToken, OauthClient $oauthClient): AccessToken;
}
