<?php

namespace Modules\Domain\Common\Contracts;

use Modules\Domain\Common\ValueObjects\AccessToken;
use Modules\Domain\Common\ValueObjects\AuthorizationCode;
use Modules\Domain\Common\ValueObjects\OauthClient;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken, OauthClient $oauthClient): AuthorizationCode;

    public function fetchAccessToken(string $refreshToken, OauthClient $oauthClient): AccessToken;
}
