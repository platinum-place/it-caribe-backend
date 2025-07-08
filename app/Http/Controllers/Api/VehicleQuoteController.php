<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\CancelVehicleRequest;
use App\Http\Requests\Api\Quote\EstimateVehicleRequest;
use App\Http\Requests\Api\Quote\IssueVehicleRequest;
use App\Models\TmpVendorProduct;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Throwable;

class VehicleQuoteController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function estimateVehicle(EstimateVehicleRequest $request)
    {
        $criteria = '((Corredor:equals:3222373000092390001) and (Product_Category:equals:Auto))';
        $products = $this->crm->searchRecords('Products', $criteria);

        $response = [];

        foreach ($products['data'] as $product) {
            $alert = '';

            if (in_array($request->get('Actividad'), $product['Restringir_veh_culos_de_uso'])) {
                return 'Uso del vehículo restringido.';
            }

            if ((date('Y') - $request->get('Anio')) > $product['Max_antig_edad']) {
                $alert = 'La antigüedad del vehículo es mayor al limite establecido.';
            }

            if ($request->get('MontoOriginal') < $product['Suma_asegurada_min'] || $request->get('MontoOriginal') > $product['Suma_asegurada_max']) {
                $alert = 'El plazo es mayor al limite establecido.';
            }

            $taxAmount = 0;

            try {
                $criteria = 'Plan:equals:'.$product['id'];
                $taxes = $this->crm->searchRecords('Tasas', $criteria);

                foreach ($taxes['data'] as $tax) {
                    // if (in_array($request->get('TipoVehiculo'), $tax['Grupo_de_veh_culo'])) {
                    if (! empty($tax['Suma_limite'])) {
                        if ($request->get('MontoOriginal') >= $tax['Suma_limite']) {
                            if (empty($tax['Suma_hasta'])) {
                                $taxAmount = $tax['Name'] / 100;
                            } elseif ($request->get('MontoOriginal') < $tax['Suma_hasta']) {
                                $taxAmount = $tax['Name'] / 100;
                            }
                        }
                    } else {
                        $taxAmount = $tax['Name'] / 100;
                    }
                    // }
                }
            } catch (Throwable $throwable) {

            }

            if (! $taxAmount) {
                $alert = 'No se encontraron tasas.';
            }

            $surchargeAmount = 0;

            $amount = 0;

            if (empty($alert)) {
                $amount = $request->get('MontoAsegurado') * ($taxAmount + ($taxAmount * $surchargeAmount));

                if ($amount > 0 and $amount < $product['Prima_m_nima']) {
                    $amount = $product['Prima_m_nima'];
                }

                $amount = round($amount, 2);
            }

            $criteria = 'Name:equals:'.VehicleMake::firstWhere('code', $request->get('Marca'))->name;
            $vehicleMake = $this->crm->searchRecords('Marcas', $criteria);

            $criteria = 'Name:equals:'.VehicleModel::firstWhere('code', $request->get('Modelo'))->name;
            $vehicleModel = $this->crm->searchRecords('Modelos', $criteria);

            $data = [
                'Subject' => $request->get('NombreCliente'),
                'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 30 days')),
                'Vigencia_desde' => date('Y-m-d'),
                'Account_Name' => 3222373000092390001,
                'Contact_Name' => 3222373000203318001,
                'Quote_Stage' => 'Cotizando',
                'Nombre' => $request->get('NombreCliente'),
                'Fecha_de_nacimiento' => date('Y-m-d', strtotime($request->get('FechaNacimiento'))),
                'RNC_C_dula' => $request->get('IdCliente'),
                'Correo_electr_nico' => $request->get('Email'),
                'Tel_Celular' => $request->get('TelefMovil'),
                'Tel_Residencia' => $request->get('TelefResidencia'),
                'Tel_Trabajo' => $request->get('TelefTrabajo'),
                'Plan' => 'Mensual Full',
                'Suma_asegurada' => round($request->get('MontoAsegurado'), 2),
                'A_o' => $request->get('Anio'),
                'Marca' => $vehicleMake['data'][0]['id'],
                'Modelo' => $vehicleModel['data'][0]['id'],
                'Tipo_veh_culo' => $request->get('TipoVehiculo'),
                'Chasis' => $request->get('Chasis'),
                'Placa' => $request->get('Placa'),
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

            $responseProduct = $this->crm->insertRecords('Quotes', $data);

            $response2 = $this->crm->getRecords('Vendors', ['Nombre'], (int) $product['Vendor_Name']['id']);

            $response[] = [
                'passcode' => null,
                'ofertaid' => null,
                'Prima' => number_format($amount - ($amount * 0.16), 1, '.', ''),
                'Impuesto' => number_format($amount * 0.16, 1, '.', ''),
                'PrimaTotal' => number_format($amount, 1, '.', ''),
                'PrimaCuota' => number_format(0.0, 1, '.', ''),
                'Planid' => TmpVendorProduct::firstWhere('id_crm', $product['id'])->id,
                'Plan' => 'Plan Mensual Full',
                'Aseguradora' => $response2['data'][0]['Nombre'],
                'IdCotizacion' => (string) $responseProduct['data'][0]['details']['id'],
                'Fecha' => date('d/m/Y H:i:s A'),
                'Error' => $alert,
                'CoberturasList' => [
                    [
                        'Cobertura' => 'Fianza judicial',
                        'Valor' => '1,000,000',
                        'Error' => null,
                    ],
                ],
            ];
        }

        $json = json_encode($response, JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function issueVehicle(IssueVehicleRequest $request)
    {
        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('cotzid'))['data'][0];

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

            $this->crm->updateRecords('Quotes', $request->get('cotzid'), $data);

            break;
        }

        return response()->json(['Error' => '']);
    }

    public function cancelVehicle(CancelVehicleRequest $request)
    {
        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('IdCotizacion'))['data'][0];

        $data = [
            'Quote_Stage' => 'Cancelada',
        ];

        $this->crm->updateRecords('Quotes', $request->get('IdCotizacion'), $data);

        return response()->json(['Error' => '']);
    }
}
