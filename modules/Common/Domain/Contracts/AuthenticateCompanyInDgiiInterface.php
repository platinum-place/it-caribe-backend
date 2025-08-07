<?php

namespace Modules\Common\Domain\Contracts;

use Modules\Tenant\Domain\Entities\Company;

interface AuthenticateCompanyInDgiiInterface
{
    public function handle(Company|string $company): string;
}
