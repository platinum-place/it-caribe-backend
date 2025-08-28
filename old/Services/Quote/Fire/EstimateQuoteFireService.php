<?php

namespace old\Services\Quote\Fire;

use App\Enums\Quote\Fire\QuoteFireRiskTypeEnum;
use Carbon\Carbon;
use old\Services\Quote\Life\EstimateQuoteLifeService;
use old\Services\Zoho\ZohoService;

class EstimateQuoteFireService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoService $zohoService)
    {
        //
    }

    public function handle(float $appraisalValue, int $quoteFireRiskTypeId, string|int $borrowerBirthDate, int $deadline, float $financedValue, string|int|null $coBorrowerBirthDate = null): array
    {
        try {
            $borrowerAge = Carbon::parse($borrowerBirthDate)->age;
        } catch (\Exception $e) {
            $borrowerAge = $borrowerBirthDate;
        }

        if (! empty($coBorrowerBirthDate)) {
            try {
                $coBorrowerAge = Carbon::parse($coBorrowerBirthDate)->age;
            } catch (\Exception $e) {
                $coBorrowerAge = $coBorrowerBirthDate;
            }
        }
        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Incendio))';
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
                $borrowerAge += $deadline / 12;
            }

            $borrowerRate = 0;
            $coBorrowerRate = 0;

            $borrowerAmount = 0;
            $coBorrowerAmount = 0;

            $borrowerRate = app(EstimateQuoteLifeService::class)->getBorrowerRate($product['id'], $borrowerAge);
            $borrowerAmount = ($financedValue / 1000) * ($borrowerRate / 100);

            if (! empty($coBorrowerBirthDate)) {
                if ($product['Edad_tasa']) {
                    $coBorrowerAge += $deadline / 12;
                }

                $coBorrowerRate = app(EstimateQuoteLifeService::class)->getCoBorrowerRate($product['id'], $coBorrowerAge);
                $coBorrowerAmount = ($financedValue / 1000) * (($coBorrowerRate - $borrowerRate) / 100);
            }

            $lifeAmount = $borrowerAmount + $coBorrowerAmount;
            /**
             * End estimate life
             */
            $amount = $lifeAmount + $fireAmount;
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $borrowerAmount = round($borrowerAmount, 2);
            $coBorrowerAmount = round($coBorrowerAmount, 2);
            $lifeAmount = round($lifeAmount, 2);
            $fireAmount = round($fireAmount, 2);

            $vendorCRM = $this->zohoService->getRecords('Vendors', ['Nombre'], $product['Vendor_Name']['id'])['data'][0];

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxesAmount,
                'total' => $amount,
                'description' => $product['id'],
                'borrower_amount' => $borrowerAmount,
                'co_borrower_amount' => $coBorrowerAmount,
                'borrower_rate' => $borrowerRate,
                'co_borrower_rate' => $coBorrowerRate,
                'financed_value' => $financedValue,
                'fire_rate' => $fireRate,
                'fire_amount' => $fireAmount,
                'life_amount' => $lifeAmount,
                'appraisal_value' => $appraisalValue,
                'error' => null,
                'vendor_name' => $vendorCRM['Nombre'],
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
