<?php

namespace Modules\Application\Common\Contracts;

interface FetchZohoRecordInterface
{
    public function handle(string $module, string $criteria): array;
}
