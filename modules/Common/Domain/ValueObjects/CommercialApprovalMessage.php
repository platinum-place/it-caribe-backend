<?php

namespace Modules\Common\Domain\ValueObjects;

class CommercialApprovalMessage
{
    public function __construct(
        public string    $value {
            get {
                return $this->value;
            }
        },
        public string $code {
            get {
                return $this->code;
            }
        },
    )
    {
    }
}
