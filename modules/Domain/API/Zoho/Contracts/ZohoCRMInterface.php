<?php

namespace Modules\Domain\API\Zoho\Contracts;

interface ZohoCRMInterface
{
    public function fetchRefreshToken(string $grantToken): array;

    public function fetchAccessToken(string $refreshToken): array;

    public function fetchRecords(string $module, string $token, array $fields, ?string $id = ''): array;
}
