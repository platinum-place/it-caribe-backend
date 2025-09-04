<?php

namespace Modules\Domain\Insurances\Core\ValueObjects;

readonly class InsuranceQuotation
{
    public function __construct(
        public float $lifeAmount,
        public float $latestExpenses,
        public float $markup,
        public float $vehicleRate,
        public string $idCrm,
        public string $vendorName,
        public float $amountTaxed,
        public float $taxRate,
        public float $taxAmount,
        public float $total,
        public float $totalMonthly,
        public float $amountWithoutLifeAmount,
    ) {
        //
    }
}
