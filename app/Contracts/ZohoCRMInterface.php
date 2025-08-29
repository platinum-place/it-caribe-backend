<?php

namespace App\Contracts;

use App\ValueObjects\Zoho\AccessToken;
use App\ValueObjects\Zoho\RefreshToken;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken): RefreshToken;

    public function fetchAccessToken(string $refreshToken): AccessToken;
}
