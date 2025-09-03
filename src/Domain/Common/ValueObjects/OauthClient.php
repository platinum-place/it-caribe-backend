<?php

namespace Modules\Domain\Common\ValueObjects;

readonly class OauthClient
{
    public function __construct(
        public string $clientId,
        public string $clientSecret,
        public ?string $redirectUri = null,
    ) {
        //
    }
}
