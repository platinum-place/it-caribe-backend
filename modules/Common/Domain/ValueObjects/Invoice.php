<?php

namespace Modules\Common\Domain\ValueObjects;

use Illuminate\Support\Collection;

class Invoice
{
    public function __construct(
        public string    $trackId {
            get {
                return $this->trackId;
            }
        },
        public string $code {
            get {
                return $this->code;
            }
        },
        public string $status {
            get {
                return $this->status;
            }
        },
        public string $senderIdentification {
            get {
                return $this->senderIdentification;
            }
        },
        public string $sequenceNumber {
            get {
                return $this->sequenceNumber;
            }
        },
        public string $sequenceUsed {
            get {
                return $this->sequenceUsed;
            }
        },
        public string $receiptDate {
            get {
                return $this->receiptDate;
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
