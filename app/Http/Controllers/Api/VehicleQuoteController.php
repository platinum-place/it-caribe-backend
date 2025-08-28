<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\CancelVehicleRequest;
use App\Http\Requests\Api\Quote\EstimateVehicleRequest;
use App\Http\Requests\Api\Quote\IssueVehicleRequest;
use App\Models\TmpVendorProduct;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Services\EstimateQuoteVehicleService;
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
        $data= $request->all();

        $vehicleMake = VehicleMake::find($data['Marca']);
        $vehicleModel = VehicleModel::find($data['Modelo']);
        $vehicleType = $vehicleModel->type;

        $criteria = '((Corredor:equals:' . 3222373000092390001 . ') and (Product_Category:equals:Auto))';
        $productsResponse = $this->crm->searchRecords('Products', $criteria);

        $response = [];

        $serviceType = 'Clásico';
        $isEmployee=false;

        foreach ($productsResponse['data'] as $product) {
            $shouldSkip = false;
            $error = '';

            if ($serviceType === 'Clásico') {
                $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
                $case2 = $product['Plan'] === 'Clásico';
                $case3 = $product['Plan'] === null;

                if (!$case1 && !$case2 && !$case3) {
                    continue;
                }
            }

            if ($serviceType === 'Japonés') {
                $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
                $case2 = $product['Plan'] === 'Japonés';
                $case3 = $product['Plan'] === null;

                if (!$case1 && !$case2 && !$case3) {
                    continue;
                }
            }


            if ($serviceType === '0 KM') {
                $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
                $case2 = $product['Plan'] === '0 KM';
                $case3 = $product['Plan'] === 'Clásico';
                $case4 = $product['Plan'] === null;

                if (!$case1 && !$case2 && !$case3 && !$case4) {
                    continue;
                }
            }

            if ($serviceType === 'Híbrido/Eléctrico') {
                $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
                $case2 = $product['Plan'] === 'Híbrido/Eléctrico';

                if (!$case1 && !$case2) {
                    continue;
                }
            }

            try {
                $criteria = 'Aseguradora:equals:' . $product['Vendor_Name']['id'];
                $restrictedVehicles = $this->crm->searchRecords('Restringidos', $criteria);
            } catch (\Throwable $e) {
                //
            }

            if (!empty($restrictedVehicles)) {
                foreach ($restrictedVehicles['data'] as $restricted) {
                    if (\Str::contains(\Str::lower($vehicleMake->name), \Str::lower($restricted['Marca']['name']))) {
                        if (empty($restricted['Modelo'])) {
                            $error = 'Marca restringido';
                            $shouldSkip = true;
                            break;
                        }

                        if (\Str::contains(\Str::lower($vehicleModel->name), \Str::lower($restricted['Modelo']['name']))) {
                            $error = 'Modelo restringido';
                            $shouldSkip = true;
                            break;
                        }
                    }
                }
            }

            $rate = app(EstimateQuoteVehicleService::class)->getRate($product['id'], $data['MontoAsegurado'], $data['Anio'], $vehicleType);

            if ($shouldSkip) {
                $rate = 0;
            }

            $amount = 0;
            $amountTaxed = 0;
            $taxesAmount = 0;
            $totalMonthly = 0;
            $lifeAmount = 0;

            if ($rate > 0) {
                $amount = $data['MontoAsegurado'] * ($rate / 100);

                if ($serviceType === 'Japonés' && !empty($product['Recargo'])) {
                    $amount *= 1.30;
                }

                $amountTaxed = $amount / 1.16;
                $taxesAmount = $amount - $amountTaxed;

                $lifeAmount = 220;

                $totalMonthly = ($amount / 12) + $lifeAmount;

                $amount = $totalMonthly * 12;

            } else {
                if(!$error){
                    $error = 'No existe tasa para el vehículo';
                }

                continue;
            }


            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $totalMonthly = round($totalMonthly, 2);

            $vendorCRM = $this->crm->getRecords('Vendors', ['Nombre'], $product['Vendor_Name']['id'])['data'][0];

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

            $response[] = [
                'passcode' => "",
                'ofertaid' => $responseProduct['data'][0]['details']['id'],
                'Prima' => number_format($amount - ($amount * 0.16), 1, '.', ''),
                'Impuesto' => number_format($amount * 0.16, 1, '.', ''),
                'PrimaTotal' => number_format($amount, 1, '.', ''),
                'PrimaCuota' => number_format($amount, 1, '.', ''),
                'Planid' => random_int(1,100),
                'Plan' => 'Plan Mensual Full',
                'Aseguradora' => $vendorCRM['Nombre'],
                'IdCotizacion' => (string) $responseProduct['data'][0]['details']['id'],
                'Fecha' => date('d/m/Y H:i:s A'),
                'Error' => null,
                'CoberturasList' => [
                    [
                        'Cobertura' => 'Fianza judicial',
                        'Valor' => '1,000,000',
                        'Error' => "",
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
