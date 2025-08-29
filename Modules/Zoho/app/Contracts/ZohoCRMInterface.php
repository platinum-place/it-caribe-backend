<?php

namespace Modules\Zoho\Contracts;

use Modules\Zoho\ValueObjects\AccessToken;
use Modules\Zoho\ValueObjects\RefreshToken;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken): RefreshToken;

    public function fetchAccessToken(string $refreshToken): AccessToken;
}
