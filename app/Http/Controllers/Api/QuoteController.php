<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\EstimateVehicleRequest;
use App\Http\Requests\Api\Quote\InspectRequest;
use App\Http\Requests\Api\Quote\IssueVehicleRequest;
use App\Http\Requests\Api\Quote\ValidateInspectionRequest;
use App\Models\Insurance\TmpQuote;
use App\Services\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Throwable;

class QuoteController extends Controller
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

            try {
                $criteria = '((Marca:equals:'.$request->get('Marca').') and (Aseguradora:equals:'.$product['Vendor_Name']['id'].'))';
                $brands = $this->crm->searchRecords('Restringidos', $criteria);

                foreach ($brands['data'] as $brand) {
                    if (empty($brand['Modelo'])) {
                        $alert = 'Marca restrigida.';
                    } elseif ($request->get('Marca') == $brand['Modelo']['id']) {
                        $alert = 'Modelo restrigido.';
                    }
                }
            } catch (Throwable $throwable) {

            }

            $taxAmount = 0;

            try {
                $criteria = 'Plan:equals:'.$product['id'];
                $taxes = $this->crm->searchRecords('Tasas', $criteria);

                foreach ($taxes['data'] as $tax) {
                    if (in_array($request->get('TipoVehiculo'), $tax['Grupo_de_veh_culo'])) {
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
                    }
                }
            } catch (Throwable $throwable) {

            }

            if (! $taxAmount) {
                $alert = 'No se encontraron tasas.';
            }

            $surchargeAmount = 0;

            try {
                $criteria = '((Marca:equals:'.$request->get('Marca').') and (Aseguradora:equals:'.$product['Vendor_Name']['id'].'))';
                $surcharges = $this->crm->searchRecords('Recargos', $criteria);

                foreach ($surcharges['data'] as $surcharge) {
                    $modeloTipo = $request->get('TipoVehiculo');
                    $modeloId = $request->get('Modelo');
                    $ano = $request->get('Marca');

                    $tipo = $surcharge['Tipo'];
                    $modelo = $surcharge['Modelo'];
                    $desde = $surcharge['Desde'];
                    $hasta = $surcharge['Hasta'];

                    $resultado = (
                        ($ano >= $desde && $ano <= $hasta && empty($modelo) && empty($tipo)) ||
                        ($ano >= $desde && $ano <= $hasta && empty($modelo) && $tipo == $modeloTipo) ||
                        ($ano >= $desde && $ano <= $hasta && $modelo == $modeloId && empty($tipo)) ||
                        ($ano >= $desde && $ano <= $hasta && $modelo == $modeloId && $tipo == $modeloTipo) ||
                        (empty($desde) && empty($hasta) && $modelo == $modeloId && $tipo == $modeloTipo) ||
                        (empty($desde) && $ano <= $hasta && $modelo == $modeloId && $tipo == $modeloTipo) ||
                        ($ano >= $desde && empty($hasta) && $modelo == $modeloId && $tipo == $modeloTipo) ||
                        ($ano >= $desde && empty($hasta) && empty($modelo) && empty($tipo)) ||
                        (empty($desde) && $ano <= $hasta && empty($modelo) && empty($tipo)) ||
                        (empty($desde) && empty($hasta) && $modelo == $modeloId && empty($tipo)) ||
                        (empty($desde) && empty($hasta) && empty($modelo) && $tipo == $modeloTipo) ||
                        (empty($desde) && empty($hasta) && empty($modelo) && empty($tipo))
                    );

                    if ($resultado) {
                        $surchargeAmount = $surcharge['Name'] / 100;
                    }
                }
            } catch (Throwable $throwable) {

            }

            $amount = 0;

            if (empty($alert)) {
                $amount = $request->get('MontoAsegurado') * ($taxAmount + ($taxAmount * $surchargeAmount));

                if ($amount > 0 and $amount < $product['Prima_m_nima']) {
                    $amount = $product['Prima_m_nima'];
                }

                $amount = round($amount, 2);
            }

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
                'Suma_asegurada' => $request->get('MontoAsegurado'),
                'A_o' => $request->get('Anio'),
                'Marca' => $request->get('Marca'),
                'Modelo' => $request->get('Modelo'),
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
            $tmp = TmpQuote::create(['id_crm' => $responseProduct['data'][0]['details']['id']]);
            $response2 = $this->crm->getRecords('Vendors', ['Nombre'], (int) $product['Vendor_Name']['id']);

            $response[] = [
                'Passcode' => null,
                'OfertaID' => null,
                'Prima' => $amount - ($amount * 0.16),
                'Impuesto' => $amount * 0.16,
                'PrimaTotal' => $amount,
                'PrimaCuota' => null,
                'Planid' => $product['id'],
                'Plan' => 'Plan Mensual Full',
                'Aseguradora' => $response2['data'][0]['Nombre'],
                'Idcotizacion' => $tmp->id,
                'Fecha' => now()->toDateTimeString(),
                'CoberturasList' => null,
                'Alerta' => $alert,
            ];
        }

        return response()->json($response);
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function issueVehicle(IssueVehicleRequest $request)
    {
        $tmp = TmpQuote::findOrFail($request->get('cotzid'));

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

    public function valueVehicle()
    {
        return response()->json([
            'valorMinimo' => '0000',
            'valorEstandar' => '000.00',
            'valorMaximo' => '000.00',
        ]);
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function validateInspection(ValidateInspectionRequest $request)
    {
        $tmp = TmpQuote::findOrFail($request->get('cotz_id'));

        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $tmp->id_crm)['data'][0];

        $data = [
            'Depurado' => true,
        ];
        $this->crm->updateRecords('Quotes', $tmp->id_crm, $data);

        return response()->json(['Error' => '']);
    }

    /**
     * @throws \Exception
     * @throws Throwable
     */
    public function inspect(InspectRequest $request)
    {
        $tmp = TmpQuote::findOrFail($request->get('cotz_id'));

        $photos = [
            'Foto1' => 'Foto Parte frontal',
            'Foto2' => 'Foto Parte trasera',
            'Foto3' => 'Foto Lateral Derecho',
            'Foto4' => 'FoFoto Interior Baul',
            'Foto5' => 'Foto Lateral Derecho',
            'Foto6' => 'Foto Chasis',
            'Foto7' => 'Foto Odometro',
            'Foto8' => 'Foto Interior',
            'Foto9' => 'Foto Motor',
            'Foto10' => 'Foto Repuesta',
            'Foto11' => 'Foto Interiooor2',
            'Foto12' => 'Foto Identificador Cliente',
            'Foto13' => 'Foto Matricula BL',
            'Foto14' => 'Otra foto',
        ];

        foreach ($photos as $photo => $title) {
            if (! $request->filled($photo)) {
                continue;
            }

            $imageData = base64_decode($request->input($photo));

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $imageData);
            finfo_close($finfo);

            $extension = match ($mimeType) {
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                default => throw new \Exception(__('validation.mimetypes', ['values' => '.jpg,.png']))
            };

            $path = "photos/{$tmp->id_crm}/uploads/".date('YmdHis')."/$title.$extension";

            Storage::put($path, $imageData);

            $this->crm->uploadAnAttachment('Quotes', $tmp->id_crm, $path);
        }

        return response()->json(['Error' => '']);
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function getQRInspect(ValidateInspectionRequest $request)
    {
        $tmp = TmpQuote::findOrFail($request->get('cotz_id'));

        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $tmp->id_crm)['data'][0];

        $qr = base64_encode(QrCode::format('svg')
            ->size(80)
            ->generate("https://gruponobesrl.zcrmportals.com/portal/GrupoNobeSRL/crm/tab/Quotes/{$tmp->id_crm}"));

        return response()->json([
            'QR' => $qr,
        ]);
    }

    /**
     * @throws Throwable
     * @throws ConnectionException
     * @throws RequestException
     */
    public function getPhotos(ValidateInspectionRequest $request)
    {
        $tmp = TmpQuote::findOrFail($request->get('cotz_id'));

        $fields = ['id', 'File_Name'];
        $attachments = $this->crm->attachmentList('Quotes', $tmp->id_crm, $fields);

        $response = [];

        foreach ($attachments['data'] as $attachment) {
            $imageData = $this->crm->getAttachment('Quotes', $tmp->id_crm, $attachment['id']);

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_buffer($finfo, $imageData);
            finfo_close($finfo);

            $extension = match ($mimeType) {
                'image/jpeg' => '.jpg',
                'image/png' => '.png',
                default => throw new \Exception(__('validation.mimetypes', ['values' => '.jpg,.png']))
            };

            $path = "photos/{$tmp->id_crm}/downloads/".date('YmdHis')."/{$attachment['File_Name']}.$extension";

            Storage::put($path, $imageData);

            $response[] = [$attachment['File_Name'] => base64_encode($imageData)];
        }

        return response()->json($response);
    }

    public function employmentTypes()
    {
        $types = [
            [
                'IdTipoEmpleado' => 3,
                'TipoEmpleado' => 'Independiente',
            ],
            [
                'IdTipoEmpleado' => 1,
                'TipoEmpleado' => 'Privado',
            ],
            [
                'IdTipoEmpleado' => 2,
                'TipoEmpleado' => 'Publico',
            ],
        ];

        return response()->json($types);
    }

    public function businessTypes()
    {
        $types = [
            [
                'IdGiroDelNegocio' => 1,
                'GiroDelNegocio' => 'COMERCIOS VARIOS',
            ],
            [
                'IdGiroDelNegocio' => 10,
                'GiroDelNegocio' => 'CONSULTORIOS MEDICOS',
            ],
            [
                'IdGiroDelNegocio' => 2,
                'GiroDelNegocio' => 'HOSPITALES/CLINICAS',
            ],
            [
                'IdGiroDelNegocio' => 9,
                'GiroDelNegocio' => 'HOTELES DE CIUDAD',
            ],
            [
                'IdGiroDelNegocio' => 12,
                'GiroDelNegocio' => 'Local comercial',
            ],
            [
                'IdGiroDelNegocio' => 4,
                'GiroDelNegocio' => 'OTROS',
            ],
        ];

        return response()->json($types);
    }
}
