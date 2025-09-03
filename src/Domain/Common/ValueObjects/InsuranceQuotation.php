<?php

namespace Modules\Domain\Common\ValueObjects;

class InsuranceQuotation
{
    public function __construct(
        public readonly float $lifeAmount,
        public readonly float $vehicleRate,
        public readonly string $idCrm,
        public readonly string $vendorName,
        public readonly float $amountTaxed,
        public readonly float $taxRate,
        public readonly float $taxAmount,
        public readonly float $total,
        public readonly float $totalMonthly,
    ) {
        //
    }
}
