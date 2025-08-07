<?php

namespace Modules\Common\Domain\Contracts;

use Modules\Common\Domain\ValueObjects\CommercialApproval;
use Modules\Common\Domain\ValueObjects\Invoice;
use Modules\Common\Domain\ValueObjects\Token;

interface DgiiApiClientInterface
{
    public function fetchSeed(string $environment): string;

    public function fetchToken(string $environment, string $seedPath): Token;

    public function sendInvoice(string $environment, string $signedXmlPath, Token $dgiiToken): Invoice;

    public function sendCommercialApproval(string $environment, string $signedXmlPath, Token $dgiiToken): CommercialApproval;
}
