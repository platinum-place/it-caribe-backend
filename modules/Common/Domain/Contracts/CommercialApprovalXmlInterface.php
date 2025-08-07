<?php

namespace Modules\Common\Domain\Contracts;

use Modules\Common\Application\DTOs\CommercialApprovalDto;

interface CommercialApprovalXmlInterface
{
    public function handle(CommercialApprovalDto $document): string;
}
