<?php

namespace Modules\Domain\Common\Entities;

class ZohoOauthClientEntity
{
    public function __construct(
        public int $id,
        public string $clientId,
        public string $clientSecret,
        public string $redirectUri,
    ) {}
}
