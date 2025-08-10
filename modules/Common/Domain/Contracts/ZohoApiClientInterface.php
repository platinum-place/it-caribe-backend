<?php

namespace Modules\Common\Domain\Contracts;

use Modules\Common\Domain\ValueObjects\ZohoToken;

interface ZohoApiClientInterface
{
    public function getPersistentToken(string $grantToken): array;

    public function getTemporaryToken(string $refreshToken): ZohoToken;
}
