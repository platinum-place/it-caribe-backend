<?php

namespace App\Contracts\Services;

interface ZohoAPIServiceContract
{
    public function getTemporaryToken(string $clientId, string $clientSecret, string $refreshToken): array;
}
