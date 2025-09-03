<?php

namespace Modules\Domain\Zoho\ValueObjects;

readonly class AccessToken
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $accessToken,
        public string $apiDomain,
        public string $tokenType,
        public int $expiresIn,
        public ?string $scope = null,
    ) {
        //
    }
}
