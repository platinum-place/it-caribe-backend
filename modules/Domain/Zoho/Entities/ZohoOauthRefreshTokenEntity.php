<?php

namespace Modules\Domain\Zoho\Entities;

class ZohoOauthRefreshTokenEntity
{
    public function __construct(
        public int $id,
        public string $refreshToken,
    ) {}
}
