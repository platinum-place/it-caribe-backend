<?php

namespace Modules\Common\Application\DTOs;

class CommercialApprovalDto
{
    public string $approvalTimestamp;

    public ?string $rejectionReasonDetail;

    public function __construct(
        public string $issuerIdentification {
            get {
                return $this->issuerIdentification;
            }
        },
        public string $receiverIdentification {
            get {
                return $this->receiverIdentification;
            }
        },
        public string $sequenceNumber {
            get {
                return $this->sequenceNumber;
            }
        },
        public string $totalAmount {
            get {
                return $this->totalAmount;
            }
        },
        public string $issueDate {
            get {
                return $this->issueDate;
            }
        },
        public string $status {
            get {
                return $this->status;
            }
        },
        ?string $rejectionReasonDetail = null,
    )
    {
        $this->approvalTimestamp = date('d-m-Y H:i:s');

        $this->rejectionReasonDetail = $rejectionReasonDetail;
    }
}
