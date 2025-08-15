<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Zoho;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class EstimateController extends Controller
{
    public function download(string $id)
    {
        $libreria = new Zoho;
        // obtener datos de la cotizacion
        $cotizacion = $libreria->getRecord('Quotes', $id);

        if ($cotizacion->getFieldValue('Quote_Stage') == 'Cotizando') {
            $pdf = Pdf::loadView('legacy.cotizaciones.cotizacion', [
                'cotizacion' => $cotizacion,
                'libreria' => $libreria,
            ]);

            return $pdf->stream('Cotización No'.$cotizacion->getFieldValue('Quote_Number').'.pdf');

            //            return view('legacy.cotizaciones.cotizacion', [
            //                'cotizacion' => $cotizacion,
            //                'libreria' => $libreria,
            //            ]);
        } else {
            // informacion sobre las coberturas, la aseguradora,las coberturas
            $plan = $libreria->getRecord('Products', $cotizacion->getFieldValue('Coberturas')
                ->getEntityId());
            $aseguradora = $libreria->getRecord('Vendors', $plan->getFieldValue('Vendor_Name')
                ->getEntityId());

            //            return view('legacy.cotizaciones.emision', [
            //                'cotizacion' => $cotizacion,
            //                'plan' => $plan,
            //                'libreria' => $libreria,
            //            ]);

            $pdf = Pdf::loadView('legacy.cotizaciones.emision', [
                'cotizacion' => $cotizacion,
                'plan' => $plan,
                'libreria' => $libreria,
                'aseguradora' => $aseguradora,
            ]);

            return $pdf->stream('Emisión No'.$cotizacion->getFieldValue('Quote_Number').'.pdf');
        }
    }

    public function condicionado($id)
    {
        $libreria = new Zoho;
        $attachments = $libreria->getAttachments('Products', $id);
        $file = $libreria->downloadAttachment('Products', $id, $attachments[0]->getId(), storage_path('app/private'));

        return response()->streamDownload(function () use ($file) {
            echo $file;
        }, 'Condicionado.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Condicionado.pdf"',
        ]);
    }
}
