<?php

namespace App\Services;

use App\Services\Api\Zoho\ZohoCRMService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteFireService
{
    protected float $debtorRate = 0;

    protected float $coDebtorRate = 0;

    public function __construct(protected ZohoCRMService $zohoApi, protected EstimateQuoteLifeService $estimateQuoteLifeService) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(string $debtorBirthDate, int $deadline, float $financedValue, ?string $coDebtorBirthDate = null): array
    {
        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Incendio))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        $debtorAge = Carbon::parse($debtorBirthDate)->age;

        foreach ($productsResponse['data'] as $product) {
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
            /**
             * End estimate life
             */

            /**
             * Start estimate fire
             */

            /**
             * End estimate fire
             */












            $amount = $debtorAmount + $coDebtorAmount;
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $debtorAmount = round($debtorAmount, 2);
            $coDebtorAmount = round($coDebtorAmount, 2);



















//            /**
//             * Estimate fire
//             */
//            $fireRate = $this->getFireRate($product['id']);
//            $fireAmount = ($appraisalValue / 1000) * ($fireRate / 100);
//
//            /**
//             * Estimate life
//             */
//            $lifeAmount = 0;
//            $debtorRate = 0;
//            $coDebtorRate = 0;
//            $debtorAmount = 0;
//            $coDebtorAmount = 0;
//            if ($financedValue) {
//                $this->getDebtorRate($product['id'], $customerAge, $coDebtorAge);
//
//                $debtorRate = $this->debtorRate / 100;
//                $coDebtorRate = $this->coDebtorRate / 100;
//                $debtorAmount = ($financedValue / 1000) * $debtorRate;
//            }
//            if (! empty($this->coDebtorRate)) {
//                $coDebtorAmount = ($financedValue / 1000) * ($coDebtorRate - $debtorRate);
//            }
//            $lifeAmount = $debtorAmount + $coDebtorAmount;
//
//            /**
//             * Totals
//             */
//            $amount = $lifeAmount + $fireAmount;
//            $amountTaxed = $amount / 1.16;
//            $taxesAmount = $amount - $amountTaxed;

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
//                'fire_rate' => $fireRate,
//                'fire_amount' => $fireAmount,
//                'life_amount' => $lifeAmount,
//                'appraisal_value' => $appraisalValue,
                'error' => null,
            ];
        }

        return $result;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    protected function getFireRate(string $productId)
    {
        $selectedRate = 0;

        $criteria = "((Plan:equals:$productId) and (Tipo:equals:Incendio))";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        foreach ($rates['data'] as $rate) {
            $selectedRate = $rate['Name'];
            break;
        }

        return $selectedRate;
    }
}
