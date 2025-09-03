<?php

namespace Modules\Domain\Common\ValueObjects;

class AuthorizationCode
{
    public function __construct(
        public string $refreshToken,
        public AccessToken $accessToken,
    ) {
        //
    }
}
