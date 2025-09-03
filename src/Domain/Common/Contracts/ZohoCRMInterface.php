<?php

namespace Modules\Domain\Common\Contracts;

use Modules\Domain\Common\ValueObjects\AccessToken;
use Modules\Domain\Common\ValueObjects\AuthorizationCode;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken, string $clientId, string $clientSecret, string $redirectUri): AuthorizationCode;

    public function fetchAccessToken(string $refreshToken, string $clientId, string $clientSecret): AccessToken;

    public function fetchRecordsByCriteria(string $module, string $accessToken, string $criteria, int $page = 1, int $perPage = 200): array;
}
