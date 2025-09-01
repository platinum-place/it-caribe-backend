<?php

namespace App\ValueObjects;

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
