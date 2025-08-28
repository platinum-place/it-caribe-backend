<?php

namespace App\Contracts;

use App\DTOs\Zoho\AccessTokenDTO;
use App\DTOs\Zoho\RefreshTokenDTO;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken): RefreshTokenDTO;

    public function fetchAccessToken(string $refreshToken): AccessTokenDTO;
}
