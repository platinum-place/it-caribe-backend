<?php

namespace Modules\Domain\API\Zoho\Contracts;

interface FetchZohoRecordInterface
{
    public function handle(string $module, string $criteria): array;
}
