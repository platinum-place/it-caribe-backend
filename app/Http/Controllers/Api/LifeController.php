<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\EstimateLifeRequest;
use App\Http\Requests\Api\Quote\IssueLifeRequest;
use App\Models\Insurance\TmpQuote;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Throwable;

class LifeController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function estimateLife(EstimateLifeRequest $request)
    {
        $criteria = '((Corredor:equals:3222373000092390001) and (Product_Category:equals:Vida))';
        $products = $this->crm->searchRecords('Products', $criteria);

        $response = [];

        foreach ($products['data'] as $product) {
            $alert = '';

            $debtTax = 0;
            $amount = 0;

            $criteria = 'Plan:equals:'.$product['id'];
            $taxes = $this->crm->searchRecords('Tasas', $criteria);
            foreach ($taxes['data'] as $tax) {
                $debtTax = $tax['Name'] / 100;
            }

            $amount = ($request->get('MontoOriginal') / 1000) * $debtTax;

            $data = [
                'Subject' => $request->get('NombreCliente'),
                'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 30 days')),
                'Vigencia_desde' => date('Y-m-d'),
                'Account_Name' => 3222373000092390001,
                'Contact_Name' => 3222373000203318001,
                'Quote_Stage' => 'Cotizando',
                'Nombre' => $request->get('NombreCliente'),
                'RNC_C_dula' => $request->get('IdenCliente'),
                'Direcci_n' => $request->get('Direccion'),
                'Tel_Celular' => $request->get('Telefono1'),
                'Plan' => 'Vida',
                'Suma_asegurada' => $request->get('MontoOriginal'),
                'Plazo' => $request->get('PlazoAnios'),
                'Fuente' => 'API',
                'Quoted_Items' => [
                    [
                        'Quantity' => 1,
                        'Product_Name' => $product['id'],
                        'Total' => round($amount, 2),
                        'Net_Total' => round($amount, 2),
                        'List_Price' => round($amount, 2),
                    ],
                ],
            ];

            $responseProduct = $this->crm->insertRecords('Quotes', $data);
            $tmp = TmpQuote::create(['id_crm' => $responseProduct['data'][0]['details']['id']]);

            $response[] = [
                'Impuesto' => number_format(0.0, 1, '.', ''),
                'Prima' => number_format($amount, 1, '.', ''),
                'identificador' => $tmp->id,
                'Aseguradora' => $product['Vendor_Name']['name'],
                'MontoOrig' => number_format($request->get('MontoOriginal'), 1, '.', ''),
                'Anios' => 0,
                'EdadTerminar' => 0,
                'Cliente' => $request->get('NombreCliente'),
                'Fecha' => date('Y-m-d\TH:i:sP'),
                'Direccion' => $request->get('Direccion'),
                'Edad' => (int) $request->get('Edad'),
                'IdenCliente' => $request->get('IdenCliente'),
                'Codeudor' => null,
                'Error' => $alert,
            ];
        }

        $json = json_encode($response, JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     * @throws RequestException
     */
    public function issueLife(IssueLifeRequest $request)
    {
        $tmp = TmpQuote::findOrFail($request->get('Identificador'));

        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $tmp->id_crm)['data'][0];

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

            $this->crm->updateRecords('Quotes', $tmp->id_crm, $data);

            break;
        }

        return response()->json(['Error' => '']);
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function cancelLife(IssueLifeRequest $request)
    {
        $tmp = TmpQuote::findOrFail($request->get('Identificador'));

        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $tmp->id_crm)['data'][0];

        $data = [
            'Quote_Stage' => 'Cancelada',
        ];

        $this->crm->updateRecords('Quotes', $tmp->id_crm, $data);

        return response()->json(['Error' => '']);
    }
}
