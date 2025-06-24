<?php

namespace App\Http\Controllers;

use App\Helpers\Zoho;
use Barryvdh\DomPDF\Facade\Pdf;
use http\Env\Response;

class EstimateController extends Controller
{
    public function download(string $id)
    {
        $libreria = new Zoho;
        // obtener datos de la cotizacion
        $cotizacion = $libreria->getRecord('Quotes', $id);

        if ($cotizacion->getFieldValue('Quote_Stage') == 'Cotizando') {
//            $pdf = Pdf::loadView('legacy.cotizaciones.cotizacion', [
//                'cotizacion' => $cotizacion,
//                'libreria' => $libreria,
//            ]);
//
//            $pdf->setPaper('A4');
//
//            return $pdf->stream("Cotización No" . $cotizacion->getFieldValue('Quote_Number') . ".pdf");

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
        $libreria = new Zoho();
        $attachments = $libreria->getAttachments("Products", $id);
        $file = $libreria->downloadAttachment("Products", $id, $attachments[0]->getId(), storage_path('app/private'));
        return response()->streamDownload(function () use ($file) {
            echo $file;
        }, "Condicionado.pdf", [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Condicionado.pdf"'
        ]);
    }
}
