<?php

namespace App\ValueObjects\Zoho;

class AccessToken
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $accessToken,
        public string $scope,
        public string $apiDomain,
        public string $tokenType,
        public int $expiresIn
    ) {
        //
    }
}
