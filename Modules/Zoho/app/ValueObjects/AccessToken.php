<?php

namespace Modules\Zoho\ValueObjects;

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
