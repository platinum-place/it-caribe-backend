<?php

namespace Modules\Domain\Common\ValueObjects;

class OauthClient
{
    public function __construct(
        public readonly string $clientId,
        public readonly string $clientSecret,
        public readonly ?string $redirectUri = null,
    ) {
        //
    }
}
