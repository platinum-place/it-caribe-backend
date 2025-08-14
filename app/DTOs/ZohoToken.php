<?php

namespace App\DTOs;

class ZohoToken
{
    public function __construct(
        public string $accessToken {
            get {
                return $this->accessToken;
            }
        },
        public string $apiDomain {
            get {
                return $this->apiDomain;
            }
        },
        public string $tokenType {
            get {
                return $this->tokenType;
            }
        },
        public string $expiresIn {
            get {
                return $this->expiresIn;
            }
        },
    )
    {
    }
}
