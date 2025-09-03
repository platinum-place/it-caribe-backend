<?php

namespace Modules\Application\Zoho\Contracts;

interface FetchZohoRecordInterface
{
    public function handle(string $module, string $criteria): array;
}
