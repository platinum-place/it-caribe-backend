<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\EstimateUnemploymentDebtRequest;
use App\Http\Requests\Api\Quote\IssueLifeRequest;
use App\Models\TmpQuote;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Throwable;

class UnemploymentDebtController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function estimateUnemploymentDebt(EstimateUnemploymentDebtRequest $request)
    {
        $criteria = '((Corredor:equals:3222373000092390001) and (Product_Category:equals:Desempleo))';
        $response = $this->crm->searchRecords('Products', $criteria);

        $quotes = [];

        foreach ($response['data'] as $product) {
            $alert = '';

            if ($request->get('PlazoDias') > $product['Plazo_max']) {
                $alert = 'El plazo es mayor al limite establecido.';
            }

            if ($request->get('MontoOriginal') < $product['Suma_asegurada_min'] || $request->get('MontoOriginal') > $product['Suma_asegurada_max']) {
                $alert = 'El plazo es mayor al limite establecido.';
            }

            $unemploymentTax = 0;
            $lifeTax = 0;
            $amount = 0;

            try {
                $criteria = 'Plan:equals:'.$product['id'];
                $taxes = $this->crm->searchRecords('Tasas', $criteria);

                foreach ($taxes['data'] as $tax) {
                    if ($request->get('TiempoLaborando') >= $tax['Edad_min'] and $request->get('TiempoLaborando') <= $tax['Edad_max']) {
                        $lifeTax = $tax['Name'] / 100;
                        $unemploymentTax = $tax['Desempleo'];
                    } else {
                        $alert = 'La edad del deudor no estan dentro del limite permitido.';
                    }
                }
            } catch (Throwable $throwable) {

            }

            if (empty($alert)) {
                $lifeAmount = ($request->get('MontoOriginal') / 1000) * $lifeTax;
                $unemploymentAmount = ($request->get('MontoOriginal') / 1000) * $unemploymentTax;
                $amount = round($lifeAmount + $unemploymentAmount, 2);
            }

            $data = [
                'Subject' => $request->get('Cliente'),
                'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 30 days')),
                'Vigencia_desde' => date('Y-m-d'),
                'Account_Name' => 3222373000092390001,
                'Contact_Name' => 3222373000203318001,
                'Quote_Stage' => 'Cotizando',
                'Nombre' => $request->get('Cliente'),
                'RNC_C_dula' => $request->get('IdentCliente'),
                'Direcci_n' => $request->get('Direccion'),
                'Tel_Celular' => $request->get('Telefono'),
                'Plan' => 'Vida/Desempleo',
                'Suma_asegurada' => round($request->get('MontoOriginal'), 2),
                'Plazo' => $request->get('Plazo') * 12,
                'Cuota' => $request->get('Cuota'),
                'Fuente' => 'API',
                'Quoted_Items' => [
                    [
                        'Quantity' => 1,
                        'Product_Name' => $product['id'],
                        'Total' => $amount,
                        'Net_Total' => $amount,
                        'List_Price' => $amount,
                    ],
                ],
            ];

            $responseQuote = $this->crm->insertRecords('Quotes', $data);
            $response2 = $this->crm->getRecords('Vendors', ['Nombre'], (int) $product['Vendor_Name']['id']);

            $quotes[] = [
                'Impuesto' => number_format($amount * 0.16, 1, '.', ''),
                'PrimaTotal' => number_format($amount, 1, '.', ''),
                'identificador' => (string)$responseQuote['data'][0]['details']['id'],
                'Cliente' => $request->get('Cliente'),
                'Direccion' => $request->get('Direccion'),
                'TipoEmpleado' => 'Publico',
                'Fecha' => date('Y-m-d\TH:i:s.vP'),
                'IdenCliente' => $request->get('IdenCliente'),
                'Telefono' => $request->get('Telefono'),
                'Aseguradora' => $response2['data'][0]['Nombre'],
                'MontoPrestamo' => number_format(0.0, 1, '.', ''),
                'Cuota' => number_format($request->get('Cuota'), 1, '.', ''),
                'PlazoMeses' => $request->get('Plazo') * 12,
                'Desempleo' => number_format($amount, 1, '.', ''),
                'Deuda' => number_format($amount, 1, '.', ''),
                'Total' => number_format($amount, 1, '.', ''),
            ];
        }

        $json = json_encode($quotes, JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function issueUnemploymentDebt(IssueLifeRequest $request)
    {
        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('Identificador'))['data'][0];

        foreach ($quote['Quoted_Items'] as $line) {
            $data = [
                'Coberturas' => $line['Product_Name']['id'],
                'Quote_Stage' => 'Emitida',
                'Vigencia_desde' => date('Y-m-d'),
                'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 1 years')),
                'Prima_neta' => round($line['Net_Total'] / 1.16, 2),
                'ISC' => round($line['Net_Total'] - ($line['Net_Total'] / 1.16), 2),
                'Prima' => round($line['Net_Total'], 2),
            ];

            $this->crm->updateRecords('Quotes', $request->get('Identificador'), $data);

            break;
        }

        return response()->json(['Error' => '']);
    }

    public function cancelUnemploymentDebt(IssueLifeRequest $request)
    {
        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('Identificador'))['data'][0];

        $data = [
            'Quote_Stage' => 'Cancelada',
        ];

        $this->crm->updateRecords('Quotes', $request->get('Identificador'), $data);

        return response()->json(['Error' => '']);
    }
}
