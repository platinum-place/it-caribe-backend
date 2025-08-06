<?php

namespace App\Services;

use App\Enums\QuoteFireRiskType;
use App\Models\QuoteUnemploymentDebtorType;
use App\Models\QuoteUnemploymentUseType;
use App\Models\VehicleType;
use App\Services\Api\Zoho\ZohoCRMService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteDebtUnemploymentService
{
    public function __construct(protected ZohoCRMService $zohoApi)
    {
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(float $insuredAmount, int $deadline,string $debtorBirthDate, float $loanInstallment, int $quoteUnemploymentTypeId, int $quoteUnemploymentUseTypeId): array
    {
        $criteria = '((Corredor:equals:' . 3222373000092390001 . ') and (Product_Category:equals:Simple))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            $rate = $this->getRate1($product['id'], $deadline);

            $amount = 0;
            $amountTaxed = 0;
            $taxesAmount = 0;

            if ($rate > 0) {
                $amount = ($insuredAmount * $rate) / 100;
                $amountTaxed = $amount / 1.16;
                $taxesAmount = $amount - $amountTaxed;
            }

            $rate = round($rate, 2);
            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);

            $vendorCRM = $this->zohoApi->getRecords('Vendors', ['Nombre'], $product['Vendor_Name']['id'])['data'][0];

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxesAmount,
                'total' => $amount,
                'rate' => $rate,
                'id_crm' => $product['id'],
                'error' => null,
                'vendor_name' => $vendorCRM['Nombre'],
            ];
        }

        return $result;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    protected function getRate1(string $productId, int $deadline)
    {
        $criteria = "Plan:equals:$productId";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        $selectedRate = 0;

        foreach ($rates['data'] as $rate) {
            if ($deadline >= $rate['Edad_min'] && $deadline <= $rate['Edad_max']) {
                $selectedRate = $rate['Name'];
            }
        }

        return $selectedRate;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    protected function getRate(string $debtorBirthDate, string $productId, string $quoteUnemploymentUseTypeId, float $loanInstallment)
    {
        try {
            $debtorAge = Carbon::parse($debtorBirthDate)->age;
        }catch (\Throwable $exception){
            $debtorAge = $debtorBirthDate;
        }

        $quoteUnemploymentUseType = QuoteUnemploymentUseType::findOrFail($quoteUnemploymentUseTypeId)->name;

        $selectedRate = 0;

        try {
            $criteria = "((Plan:equals:$productId) and (Tipo:equals:$quoteUnemploymentUseType))";
            $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

            foreach ($rates['data'] as $rate) {
                if ($debtorAge >= $rate['Edad_min'] && $debtorAge <= $rate['Edad_max']) {
                    $selectedRate = $rate['Name'];
                }
            }
        } catch (\Throwable $e) {
            $criteria = "Plan:equals:$productId";
            $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

            foreach ($rates['data'] as $rate) {
                if ($loanInstallment >= $rate['Suma_limite'] && $loanInstallment <= $rate['Suma_hasta']) {
                    $selectedRate = round($rate['Name'], 2);
                }
            }
        }

        return $selectedRate;
    }
}
