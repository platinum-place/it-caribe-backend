<?php

namespace App\Services;

use App\forlder\QuoteFireRiskType;
use App\Services\Zoho\ZohoCRMService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteFireService
{
    public function __construct(protected ZohoCRMService $zohoApi, protected EstimateQuoteLifeService $estimateQuoteLifeService) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(float $appraisalValue, int $quoteFireRiskTypeId, string $debtorBirthDate, int $deadline, float $financedValue, ?string $coDebtorBirthDate = null): array
    {
        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Incendio))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        if ($quoteFireRiskTypeId === QuoteFireRiskType::HOUSING->value) {
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
            $debtorAge = Carbon::parse($debtorBirthDate)->age;

            if ($product['Edad_tasa']) {
                $debtorAge += $deadline / 12;
            }

            $debtorRate = 0;
            $coDebtorRate = 0;

            $debtorAmount = 0;
            $coDebtorAmount = 0;

            $debtorRate = $this->estimateQuoteLifeService->getDebtorRate($product['id'], $debtorAge);
            $debtorAmount = ($financedValue / 1000) * ($debtorRate / 100);

            if (! empty($coDebtorBirthDate)) {
                $coDebtorAge = Carbon::parse($coDebtorBirthDate)->age;

                if ($product['Edad_tasa']) {
                    $coDebtorAge += $deadline / 12;
                }

                $coDebtorRate = $this->estimateQuoteLifeService->getCodebtorRate($product['id'], $coDebtorAge);
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
            $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

            foreach ($rates['data'] as $rate) {
                $selectedRate = $rate['Name'];
            }

            return $selectedRate;
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
