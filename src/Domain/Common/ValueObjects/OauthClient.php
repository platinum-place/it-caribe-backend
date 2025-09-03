<?php

namespace Modules\Domain\Common\ValueObjects;

class OauthClient
{
    public function __construct(
        public string $clientId,
        public string $clientSecret,
        public ?string $redirectUri = null,
    ) {
        //
    }
}
