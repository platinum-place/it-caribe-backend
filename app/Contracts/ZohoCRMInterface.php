<?php

namespace App\Contracts;

use App\ValueObjects\AccessToken;
use App\ValueObjects\AuthorizationCode;
use App\ValueObjects\OauthClient;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken, OauthClient $oauthClient): AuthorizationCode;

    public function fetchAccessToken(string $refreshToken, OauthClient $oauthClient): AccessToken;
}
