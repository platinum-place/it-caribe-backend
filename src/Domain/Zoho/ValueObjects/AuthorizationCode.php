<?php

namespace Modules\Domain\Zoho\ValueObjects;

readonly class AuthorizationCode
{
    public function __construct(
        public string $refreshToken,
        public AccessToken $accessToken,
    ) {
        //
    }
}
