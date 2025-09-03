<?php

namespace Modules\Domain\Common\ValueObjects;

class AccessToken
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public readonly string $accessToken,
        public readonly string $apiDomain,
        public readonly string $tokenType,
        public readonly int $expiresIn,
        public readonly ?string $scope = null,
    ) {
        //
    }
}
