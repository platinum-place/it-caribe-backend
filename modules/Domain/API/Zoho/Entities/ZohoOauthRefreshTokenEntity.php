<?php

namespace Modules\Domain\API\Zoho\Entities;

class ZohoOauthRefreshTokenEntity
{
    public function __construct(
        public int $id,
        public string $refreshToken,
    ) {}
}
