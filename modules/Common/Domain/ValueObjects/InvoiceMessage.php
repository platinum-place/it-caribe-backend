<?php

namespace Modules\Common\Domain\ValueObjects;

class InvoiceMessage
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
