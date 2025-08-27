<?php

namespace App\Services\Quote\Fire;

use App\Enums\Quote\Fire\QuoteFireRiskTypeEnum;
use App\Services\Quote\Life\EstimateQuoteLifeService;
use App\Services\Zoho\ZohoService;
use Carbon\Carbon;

class EstimateQuoteFireService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoService $zohoService)
    {
        //
    }

    public function handle(float $appraisalValue, int $quoteFireRiskTypeId, string|int $debtorBirthDate, int $deadline, float $financedValue, string|int|null $coDebtorBirthDate = null): array
    {
        try {
            $debtorAge = Carbon::parse($debtorBirthDate)->age;
        } catch (\Exception $e) {
            $debtorAge = $debtorBirthDate;
        }

        if (!empty($coDebtorBirthDate)) {
            try {
                $coDebtorAge = Carbon::parse($coDebtorBirthDate)->age;
            } catch (\Exception $e) {
                $coDebtorAge = $coDebtorBirthDate;
            }
        }
        $criteria = '((Corredor:equals:' . 3222373000092390001 . ') and (Product_Category:equals:Incendio))';
        $productsResponse = $this->zohoService->searchRecords('Products', $criteria);

        $result = [];

        if ($quoteFireRiskTypeId === QuoteFireRiskTypeEnum::HOUSING->value) {
            $quoteFireRiskType = 'Vivienda';
        } else {
            $quoteFireRiskType = 'Comercial';
        }

        foreach ($productsResponse['data'] as $product) {
            /**
             * Start estimate fire
             */
            $fireRate = $this->getFireRate($product['id'], $quoteFireRiskType);

            $fireAmount = ($appraisalValue / 1000) * ($fireRate / 100);
            /**
             * End estimate fire
             */

            /**
             * Start estimate life
             */

            if ($product['Edad_tasa']) {
                $debtorAge += $deadline / 12;
            }

            $debtorRate = 0;
            $coDebtorRate = 0;

            $debtorAmount = 0;
            $coDebtorAmount = 0;

            $debtorRate = app(EstimateQuoteLifeService::class)->getBorrowerRate($product['id'], $debtorAge);
            $debtorAmount = ($financedValue / 1000) * ($debtorRate / 100);

            if (!empty($coDebtorBirthDate)) {
                $coDebtorAge = Carbon::parse($coDebtorBirthDate)->age;

                if ($product['Edad_tasa']) {
                    $coDebtorAge += $deadline / 12;
                }

                $coDebtorRate = app(EstimateQuoteLifeService::class)->getCodebtorRate($product['id'], $coDebtorAge);
                $coDebtorAmount = ($financedValue / 1000) * (($coDebtorRate - $debtorRate) / 100);
            }

            $lifeAmount = $debtorAmount + $coDebtorAmount;
            /**
             * End estimate life
             */
            $amount = $lifeAmount + $fireAmount;
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $debtorAmount = round($debtorAmount, 2);
            $coDebtorAmount = round($coDebtorAmount, 2);
            $lifeAmount = round($lifeAmount, 2);
            $fireAmount = round($fireAmount, 2);

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxesAmount,
                'total' => $amount,
                'id_crm' => $product['id'],
                'debtor_amount' => $debtorAmount,
                'co_debtor_amount' => $coDebtorAmount,
                'debtor_rate' => $debtorRate,
                'co_debtor_rate' => $coDebtorRate,
                'financed_value' => $financedValue,
                'fire_rate' => $fireRate,
                'fire_amount' => $fireAmount,
                'life_amount' => $lifeAmount,
                'appraisal_value' => $appraisalValue,
                'error' => null,
            ];
        }

        return $result;
    }

    protected function getFireRate(string $productId, string $quoteFireRiskType)
    {
        $selectedRate = 0;

        try {
            $criteria = "((Plan:equals:$productId) and (Tipo:equals:$quoteFireRiskType))";
            $rates = $this->zohoService->searchRecords('Tasas', $criteria);

            foreach ($rates['data'] as $rate) {
                $selectedRate = $rate['Name'];
            }

            return $selectedRate;
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
