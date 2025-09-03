<?php

namespace Modules\Domain\Common\ValueObjects;

class AuthorizationCode
{
    public function __construct(
        public readonly string $refreshToken,
        public readonly AccessToken $accessToken,
    ) {
        //
    }
}
