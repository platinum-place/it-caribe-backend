<?php

namespace Modules\Common\Domain\Contracts;

use Modules\Tenant\Domain\Entities\Company;

interface CompanyRepositoryInterface
{
    public function findById(string $id): Company;

    public function validateCompanyId(string $companyId): bool;

    public function validateWhitelist(string $companyId, string $ip): bool;
}
