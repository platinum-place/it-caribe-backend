<?php

namespace App\Services\Quote\Life;

use App\Services\Zoho\ZohoService;
use Carbon\Carbon;

class EstimateQuoteLifeService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoService $zohoService)
    {
        //
    }

    public function handle(string $borrowerBirthDate, int $deadline, float $insuredAmount, ?string $coBorrowerBirthDate = null, ?int $coBorrowerAge = null)
    {
        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Vida))';
        $productsResponse = $this->zohoService->searchRecords('Products', $criteria);

        $borrowerAge = Carbon::parse($borrowerBirthDate)->age;

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            if ($product['Edad_tasa']) {
                $borrowerAge += $deadline / 12;
            }

            $coBorrowerRate = 0;

            $coBorrowerAmount = 0;

            $borrowerRate = $this->getBorrowerRate($product['id'], $borrowerAge);
            $borrowerAmount = ($insuredAmount / 1000) * ($borrowerRate / 100);

            if (! empty($coBorrowerBirthDate) || ! empty($coBorrowerAge)) {
                if (! $coBorrowerAge) {
                    $coBorrowerAge = Carbon::parse($coBorrowerBirthDate)->age;
                }

                if ($product['Edad_tasa']) {
                    $coBorrowerAge += $deadline / 12;
                }

                $coBorrowerRate = $this->getCoBorrowerRate($product['id'], $coBorrowerAge);
                $coBorrowerAmount = ($insuredAmount / 1000) * (($coBorrowerRate - $borrowerRate) / 100);
            }

            $amount = $borrowerAmount + $coBorrowerAmount;
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $borrowerAmount = round($borrowerAmount, 2);
            $coBorrowerAmount = round($coBorrowerAmount, 2);

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
                'error' => null,
                'vendor_name' => $vendorCRM['Nombre'],
            ];
        }

        return $result;
    }

    public function getBorrowerRate(string $productId, int $borrowerAge)
    {
        $criteria = "((Plan:equals:$productId) and (Tipo:equals:Deudor))";
        $rates = $this->zohoService->searchRecords('Tasas', $criteria);

        $selectedRate = 0;

        foreach ($rates['data'] as $rate) {
            if ($borrowerAge >= $rate['Edad_min'] && $borrowerAge <= $rate['Edad_max']) {
                $selectedRate = $rate['Name'];
            }
        }

        return $selectedRate;
    }

    public function getCoBorrowerRate(string $productId, int $coBorrowerAge)
    {
        $criteria = "((Plan:equals:$productId) and (Tipo:equals:Codeudor))";
        $rates = $this->zohoService->searchRecords('Tasas', $criteria);

        $selectedRate = 0;

        foreach ($rates['data'] as $rate) {
            if ($coBorrowerAge >= $rate['Edad_min'] && $coBorrowerAge <= $rate['Edad_max']) {
                $selectedRate = $rate['Name'];
            }
        }

        return $selectedRate;
    }
}
