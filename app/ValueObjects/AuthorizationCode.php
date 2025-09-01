<?php

namespace App\ValueObjects;

class AuthorizationCode
{
    public function __construct(
        public string $refreshToken,
        public AccessToken $accessToken,
    ) {
        //
    }
}
