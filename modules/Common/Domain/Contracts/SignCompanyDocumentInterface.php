<?php

namespace Modules\Common\Domain\Contracts;

use Modules\Common\Domain\ValueObjects\DocumentSigned;
use Modules\Tenant\Domain\Entities\Company;

interface SignCompanyDocumentInterface
{
    public function handle(Company|string $company, string $xmlName, string $xmlContent): DocumentSigned;
}
