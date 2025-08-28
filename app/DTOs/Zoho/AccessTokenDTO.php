<?php

namespace App\DTOs\Zoho;

class AccessTokenDTO
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
