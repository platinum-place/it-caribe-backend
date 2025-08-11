<?php

namespace Modules\Common\Domain\Contracts;

use Modules\Common\Domain\ValueObjects\ZohoToken;

interface ZohoApiClientInterface
{
    public function getPersistentToken(string $grantToken): array;

    public function getTemporaryToken(string $refreshToken): ZohoToken;

    public function searchRecords(string $module, string $token, string $criteria, int $page = 1, int $perPage = 200): ?array;

    public function getRecords(string $module, string $token, array $fields, ?string $id = ''): ?array;
}
