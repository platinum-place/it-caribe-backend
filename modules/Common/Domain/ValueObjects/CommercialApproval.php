<?php

namespace Modules\Common\Domain\ValueObjects;

use Illuminate\Support\Collection;

class CommercialApproval
{
    public function __construct(
        public string    $status {
            get {
                return $this->status;
            }
        },
        public string $code {
            get {
                return $this->code;
            }
        },
        public Collection $messages {
            get {
                return $this->messages;
            }
        },
    )
    {
    }
}
