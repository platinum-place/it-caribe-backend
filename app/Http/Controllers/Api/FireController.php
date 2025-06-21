<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\EstimateFireRequest;
use App\Http\Requests\Api\Quote\IssueLifeRequest;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Throwable;

class FireController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function estimateFire(EstimateFireRequest $request)
    {
        $criteria = '((Corredor:equals:3222373000092390001) and (Product_Category:equals:Incendio))';
        $response = $this->crm->searchRecords('Products', $criteria);

        $quotes = [];

        foreach ($response['data'] as $product) {
            $alert = '';

            $tax = 0;
            $amount = 0;

            try {
                $criteria = 'Plan:equals:'.$product['id'];
                $taxes = $this->crm->searchRecords('Tasas', $criteria);

                foreach ($taxes['data'] as $tax) {
                    $tax = $tax['Name'] / 100;
                }
            } catch (Throwable $throwable) {

            }

            if (empty($alert)) {
                $amount = ($request->get('MontoOriginal') / 100) * $tax;
                $amount = round($amount, 2);
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
                'Plan' => 'Incendio',
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

            $quotes[] = [
                'Impuesto' => number_format($amount * 0.16, 1, '.', ''),
                'Prima' => number_format($amount, 1, '.', ''),
                'Cuota' => number_format($request->get('Cuota'), 1, '.', ''),
                'Plazo' => $request->get('Plazo'),
                'TiempoLaborando' => (int) $request->get('TiempoLaborando'),
                'MontoOriginal' => number_format($request->get('MontoOriginal'), 1, '.', ''),
                'idTipoEmpleado' => $request->get('IdentCliente'),
                'FormaDePago' => $request->get('FormaDePago'),
                'IdentCliente' => $request->get('IdentCliente'),
                'Cliente' => $request->get('Cliente'),
                'Direccion' => $request->get('Ubicacion'),
                'Telefono' => $request->get('Telefono'),
                'idGiroDelNegocio' => $request->get('idGiroDelNegocio'),
                'FechaEmision' => $request->get('FechaEmision'),
                'FechaVencimiento' => $request->get('FechaVencimiento'),
                'ValorFinanciado' => number_format(0.0, 1, '.', ''),
                'Construccion' => 'Vivienda',
                'TipoConstruccion' => 'Superior',
                'Ubicacion' => $request->get('Ubicacion'),
                'identificador' => number_to_uuid($responseQuote['data'][0]['details']['id']),
                'Aseguradora' => $product['Vendor_Name']['name'],
                'Error' => $alert,
                'PrimaVida' => number_format(0.0, 1, '.', ''),
                'cotz_id' => $responseQuote['data'][0]['details']['id'],
                'CoberturasListInc' => [
                    [
                        'Cobertura' => 'Responsabilidad civil básica',
                        'Valor' => '1,000,000',
                        'Error' => '',
                    ],
                    [
                        'Cobertura' => 'Remoción de escombros',
                        'Valor' => '1,000,000',
                        'Error' => '10%',
                    ],
                ],
                'CoberturasListVid' => [
                    [
                        'Cobertura' => 'Responsabilidad civil básica',
                        'Valor' => '1,000,000',
                        'Error' => '',
                    ],
                ],
                'PrimaTotal' => number_format($amount, 1, '.', ''),
                'Valor' => number_format($request->get('MontoOriginal'), 1, '.', ''),
                'Anios' => 0,
                'EdadTerminar' => 0,
                'EdadCodeudor' => 0,
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
    public function issueFire(IssueLifeRequest $request)
    {
        $id = uuid_to_number($request->get('Identificador'));

        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $id)['data'][0];

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

            $this->crm->updateRecords('Quotes', $id, $data);

            break;
        }

        return response()->json(['Error' => '']);
    }

    public function cancelFire(IssueLifeRequest $request)
    {
        $id = uuid_to_number($request->get('Identificador'));

        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $id)['data'][0];

        $data = [
            'Quote_Stage' => 'Cancelada',
        ];

        $this->crm->updateRecords('Quotes', $id, $data);

        return response()->json(['Error' => '']);
    }
}
