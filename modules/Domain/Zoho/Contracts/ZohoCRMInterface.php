<?php

namespace Modules\Domain\Zoho\Contracts;

use Modules\Domain\Zoho\ValueObjects\AccessToken;
use Modules\Domain\Zoho\ValueObjects\AuthorizationCode;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken, string $clientId, string $clientSecret, string $redirectUri): AuthorizationCode;

    public function fetchAccessToken(string $refreshToken, string $clientId, string $clientSecret): AccessToken;

    public function fetchRecordsByCriteria(string $module, string $accessToken, string $criteria, int $page = 1, int $perPage = 200): array;
}
