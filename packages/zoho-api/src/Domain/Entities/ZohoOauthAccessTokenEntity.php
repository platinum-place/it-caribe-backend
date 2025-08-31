<?php

namespace Root\ZohoApi\Domain\Entities;

class ZohoOauthAccessTokenEntity
{
    public function __construct(
        public int $id,
        public string $accessToken,
        public string $apiDomain,
        public string $tokenType,
        public int $expiresIn,
        public string $expiresAt,
        public ?string $scope,
    ) {}
}
