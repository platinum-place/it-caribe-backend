<?php

namespace App\Http\Controllers;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Helpers\CotizarDesempleo;
use App\Helpers\CotizarIncendio;
use App\Helpers\CotizarIncendio2;
use App\Helpers\CotizarVida;
use App\Helpers\Zoho;
use Illuminate\Http\Request;

class LegacyController extends Controller
{
    public function index(Request $request)
    {
        // libreria con funciones de zoho
        $libreria = new Cotizaciones;

        // objeto para almacenar valores relacionados a la cotizacion
        $cotizacion = new Cotizacion;

        if ($request->get('suma')) {
            // libreria con funciones de zoho
            $libreria = new Cotizaciones;

            // objeto para almacenar valores relacionados a la cotizacion
            $cotizacion = new Cotizacion;

            // informacion general
            $cotizacion->suma = $request->get('suma');
            $cotizacion->plan = $request->get('plan');
            $cotizacion->plazo = $request->get('plazo');
            $cotizacion->fecha_deudor = $request->get('deudor');

            switch ($cotizacion->plan) {
                case 'Seguro Incendio Leasing':
                    // informacion sobre plan incendio
                    $cotizacion->direccion = $request->get('direccion');
                    $cotizacion->prestamo = $request->get('prestamo');
                    $cotizacion->tipo_equipo = $request->get('tipo_equipo');

                    $cotizar = new CotizarIncendio2($cotizacion, $libreria);
                    break;

                case 'Vida':
                    // informacion del plan vida
                    $cotizacion->fecha_codeudor = $request->get('codeudor');
                    $cotizacion->garante = $request->get('garante');
                    $cotizacion->tipo_pago = $request->get('tipo_pago');

                    $cotizar = new CotizarVida($cotizacion, $libreria);
                    break;

                case 'Seguro Incendio Hipotecario':
                    // informacion sobre plan incendio
                    $cotizacion->direccion = $request->get('direccion');
                    $cotizacion->prestamo = $request->get('prestamo');
                    $cotizacion->construccion = $request->get('construccion');
                    $cotizacion->riesgo = $request->get('riesgo');

                    $cotizar = new CotizarIncendio($cotizacion, $libreria);
                    break;

                case 'Vida/Desempleo':
                    // informacion del plan desempleo
                    $cotizacion->cuota = $request->get('cuota');

                    $cotizar = new CotizarDesempleo($cotizacion, $libreria);
                    break;

                default:
                    // informacion para el plan auto
                    $cotizacion->plan = $request->get('plan');
                    $cotizacion->ano = $request->get('ano');
                    $cotizacion->uso = $request->get('uso');
                    $cotizacion->estado = $request->get('estado');
                    $cotizacion->marcaid = $request->get('marca');
                    // datos relacionados al modelo, dividios en un array
                    $modelo = explode(',', $request->get('modelo'));
                    // asignando valores al objeto
                    $modeloid = $modelo[0];
                    $modelotipo = $modelo[1];
                    $cotizacion->modeloid = $modeloid;
                    $cotizacion->modelotipo = $modelotipo;
                    $cotizacion->salvamento = $request->get('salvamento');

                    $cotizar = new CotizarAuto($cotizacion, $libreria);
                    break;
            }

            $cotizar->cotizar_planes();

            //        //en caso de no encontrar planes para cotizar
            //        if (empty($cotizacion->planes)) {
            //            session()->setFlashdata('alerta', 'No existen planes para cotizar.');
            //        }
        }

        $criterio = 'Corredor:equals:'. 3222373000092390001;
        $planes = $libreria->searchRecordsByCriteria('Products', $criterio);

        $tiene_plan = [];
        foreach ($planes as $plan) {
            $tiene_plan[$plan->getFieldValue('Product_Category')] = true;
        }

        // libreria del api para obtener todo los registros de un modulo, en este caso del de marcas
        $marcas = $libreria->getRecords('Marcas');

        // formatear el resultado para ordenarlo alfabeticamente en forma descendente
        asort($marcas);

        return view('legacy.index', [
            'titulo' => 'Cotizar',
            'marcas' => $marcas,
            'cotizacion' => $cotizacion,
            'plan' => $tiene_plan,
        ]);
    }

    public function lista_modelos(Request $request)
    {
        // inicializar el contador
        $pag = 1;
        $libreria = new Zoho;
        // criterio de aseguir por la api
        $criteria = 'Marca:equals:'.$request->get('marcaid');
        // repetir en secuencia para obtener todo los modelos de una misma marca,
        // teniendo en cuenta que pueden ser mas de 200 en algunos casos
        // por tanto en necesario recontar la sentencia pero variando en paginas para superar el limite de la api
        do {
            // obtener los modelos empezando por la primera pagina
            $modelos = $libreria->searchRecordsByCriteria('Modelos', $criteria, $pag);
            // en caso de encontrar valores
            if (! empty($modelos)) {
                // formatear el resultado para ordenarlo alfabeticamente en forma descendente
                asort($modelos);
                // aumentar el contador
                $pag++;
                // mostrar los valores en forma de option para luego ser mostrados en dentro de un select
                foreach ($modelos as $modelo) {
                    echo '<option value="'.$modelo->getEntityId().','.$modelo->getFieldValue('Tipo').'">'.strtoupper($modelo->getFieldValue('Name')).' ('.$modelo->getFieldValue('Tipo').')'.'</option>';
                }
            } else {
                // igualar a 0 el contador para salir del ciclo
                $pag = 0;
            }
        } while ($pag > 0);
    }

    public function completar(Request $request)
    {
        // pasa la tabla de cotizacion en array para agregarla al registro
        $planes = json_decode($request->get('planes'), true);
        $registro = [
            'Subject' => $request->get('nombre').' '.$request->get('apellido'),
            'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 30 days')),
            'Vigencia_desde' => date('Y-m-d'),
            'Account_Name' => 3222373000092390001,
            'Contact_Name' => 3222373000203318001,
            'Construcci_n' => $request->get('construccion'),
            'Riesgo' => $request->get('riesgo'),
            'Quote_Stage' => 'Cotizando',
            'Nombre' => $request->get('nombre'),
            'Apellido' => $request->get('apellido'),
            'Fecha_de_nacimiento' => $request->get('fecha'),
            'RNC_C_dula' => $request->get('rnc_cedula'),
            'Correo_electr_nico' => $request->get('correo'),
            'Direcci_n' => $request->get('direccion'),
            'Tel_Celular' => $request->get('telefono'),
            'Tel_Residencia' => $request->get('tel_residencia'),
            'Tel_Trabajo' => $request->get('tel_trabajo'),
            'Plan' => $request->get('plan'),
            'Tipo' => $request->get('tipo'),
            'Suma_asegurada' => $request->get('suma'),
            'Plazo' => $request->get('plazo'),
            'Cuota' => $request->get('cuota'),
            'Prestamo' => $request->get('prestamo'),
            'A_o' => $request->get('ano'),
            'Marca' => $request->get('marcaid'),
            'Modelo' => $request->get('modeloid'),
            'Uso' => $request->get('uso'),
            'Tipo_veh_culo' => $request->get('modelotipo'),
            'Chasis' => $request->get('chasis'),
            'Color' => $request->get('color'),
            'Placa' => $request->get('placa'),
            'Condiciones' => $request->get('estado'),
            'Nombre_codeudor' => $request->get('nombre_codeudor'),
            'Apellido_codeudor' => $request->get('apellido_codeudor'),
            'Tel_Celular_codeudor' => $request->get('telefono_codeudor'),
            'Tel_Residencia_codeudor' => $request->get('tel_residencia_codeudor'),
            'Tel_Trabajo_codeudor' => $request->get('tel_trabajo_codeudor'),
            'RNC_C_dula_codeudor' => $request->get('rnc_cedula_codeudor'),
            'Fecha_de_nacimiento_codeudor' => $request->get('fecha_codeudor'),
            'Direcci_n_codeudor' => $request->get('direccion_codeudor'),
            'Correo_electr_nico_codeudor' => $request->get('correo_codeudor'),
            'Tipo_equipo' => $request->get('tipo_equipo'),
            'Salvamento' => ($request->get('salvamento')) ? true : false,
            'Garante' => ($request->get('garante')) ? true : false,
            'Tipo_de_pago' => $request->get('tipo_pago'),
        ];

        $libreria = new Zoho;
        $id = $libreria->createRecords('Quotes', $registro, $planes);

        //        $alerta = view("alertas/completar_cotizacion");
        //        session()->setFlashdata('alerta', $alerta);
        return redirect()->to('cotizaciones/emitir/'.$id);
    }

    public function buscar_cotizaciones(): string
    {
        $libreria = new Cotizaciones;
        $cotizaciones = $libreria->lista_cotizaciones();

        return view('legacy.cotizaciones.buscar_cotizaciones', [
            'titulo' => 'Buscar Cotizaciones',
            'cotizaciones' => $cotizaciones,
        ]);
    }

    public function emitir(Request $request, $id)
    {
        $libreria = new Cotizaciones;

        // obtener los datos de la cotizacion, la funcion es heredada de la libreria del api
        $cotizacion = $libreria->getRecord('Quotes', $id);

        $cliente = $cotizacion->getFieldValue('Nombre').' '.$cotizacion->getFieldValue('Apellido');

        if ($request->get('planid')) {
            // actualizar los datos de la cotizacion
            $libreria->actualizar_cotizacion($cotizacion, $request->get('planid'));

            // los archivos debe ser subida al servidor para luego ser adjuntados al registro
            //            if ($documentos = $request->getFiles()) {
            //                $libreria->adjuntar_archivo($documentos['documentos'], $id);
            //            }

            $plan = $request->get('planid');

            $plan_detalles = $libreria->getRecord('Products', $plan);

            $aseguradora = $plan_detalles->getFieldValue('Vendor_Name')->getLookupLabel();

            //            $alerta = view("alertas/emitir_cotizacion", ["id" => $id, "cliente" => $cliente, "plan" => $plan, "aseguradora" => $aseguradora]);
            //            session()->setFlashdata('alerta', $alerta);
            return redirect()->to('cotizaciones/buscar_emisiones');
        }

        return view('legacy.cotizaciones.emitir', [
            'titulo' => "Emitir Cotización de $cliente",
            'cotizacion' => $cotizacion,
        ]);
    }

    public function descargar($id)
    {
        $libreria = new Zoho;
        // obtener datos de la cotizacion
        $cotizacion = $libreria->getRecord('Quotes', $id);

        if ($cotizacion->getFieldValue('Quote_Stage') == 'Cotizando') {
            return view('legacy.cotizaciones.cotizacion', [
                'cotizacion' => $cotizacion,
                'libreria' => $libreria,
            ]);
        } else {
            // informacion sobre las coberturas, la aseguradora,las coberturas
            $plan = $libreria->getRecord('Products', $cotizacion->getFieldValue('Coberturas')
                ->getEntityId());

            return view('legacy.cotizaciones.emision', [
                'cotizacion' => $cotizacion,
                'plan' => $plan,
                'libreria' => $libreria,
            ]);
        }
    }

    public function condicionado($id)
    {
        $libreria = new Zoho;
        // obtener los todos los adjuntos del plan, normalmente es solo uno
        $attachments = $libreria->getAttachments('Products', $id);
        foreach ($attachments as $attchmentIns) {
            // descargar un documento en el servidor local
            $file = $libreria->downloadAttachment('Products', $id, $attchmentIns->getId(), storage_path('uploads'));

            return response()->streamDownload(function () use ($file) {
                return $file;
            }, 'Condicionado.pdf');
            /*
            // forzar al navegador a descargar el archivo
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            // eliminar el archivo descargado
            unlink($file);
            exit();
             * */
        }
    }

    public function buscar_emisiones()
    {
        $libreria = new Cotizaciones;
        $cotizaciones = $libreria->lista_emisiones();

        return view('legacy.cotizaciones.buscar_emisiones', [
            'titulo' => 'Buscar Emisiones',
            'cotizaciones' => $cotizaciones,
        ]);
    }
}
