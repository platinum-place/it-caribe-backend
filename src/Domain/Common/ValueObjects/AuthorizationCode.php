<?php

namespace Modules\Domain\Common\ValueObjects;

readonly class AuthorizationCode
{
    public function __construct(
        public string $refreshToken,
        public AccessToken $accessToken,
    ) {
        //
    }
}
