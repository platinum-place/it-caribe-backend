<?php

namespace App\ValueObjects\Zoho;

class RefreshToken
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $accessToken,
        public string $refreshToken,
        public string $apiDomain,
        public string $tokenType,
        public int $expiresIn,

    ) {
        //
    }
}
