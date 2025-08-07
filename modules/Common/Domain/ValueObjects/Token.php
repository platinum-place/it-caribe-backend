<?php

namespace Modules\Common\Domain\ValueObjects;

class Token
{
    public function __construct(
        public string    $token {
            get {
                return $this->token;
            }
        },
        public ?string $expirationDate = null {
            get {
                return $this->expirationDate;
            }
        },
        public ?string $issueDate = null {
            get {
                return $this->issueDate;
            }
        },
        public ?array $response = null {
            get {
                return $this->response;
            }
        },
    ) {}
}
