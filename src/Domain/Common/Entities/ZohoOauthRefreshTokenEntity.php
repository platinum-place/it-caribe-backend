<?php

namespace Modules\Domain\Common\Entities;

class ZohoOauthRefreshTokenEntity
{
    public function __construct(
        public int $id,
        public string $refreshToken,
    ) {}
}
