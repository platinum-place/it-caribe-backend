<?php

namespace App\Http\Controllers;

use App\Models\Quote\Vehicle\QuoteVehicle;
use App\Services\Zoho\ZohoCRMService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(QuoteVehicle $quoteVehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteVehicle $quoteVehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteVehicle $quoteVehicle)
    {
        //
    }

    public function download(QuoteVehicle $quoteVehicle)
    {
        $quote = $quoteVehicle->quote;

        $title = 'Cotización No. '.$quoteVehicle->id;

        $pdf = Pdf::loadView('quote-vehicles.download', [
            'quoteVehicle' => $quoteVehicle,
            'quote' => $quote,
            'lines' => $quote->lines,
            'debtor' => $quote->debtor,
            'vehicle' => $quoteVehicle->vehicle,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }

    public function downloadCertificate(QuoteVehicle $quoteVehicle)
    {
        $quote = $quoteVehicle->quote;
        $selectedLine = $quote->selectedLine;

        $productCRM = app(ZohoCRMService::class)->getRecords('Products', [
            'Lesiones_muerte_1_pers',
            'Lesiones_muerte_m_s_1_pers',
            'Da_os_propiedad_ajena',
            'Incendio_y_robo',
            'Colisi_n_y_vuelco',
            'Riesgos_comprensivos',
            'Rotura_de_cristales_deducible',
            'Fianza_judicial',
            'Lesiones_muerte_1_pas',
            'Lesiones_muerte_m_s_1_pas',
            'Riesgos_conductor',
            'Asistencia_vial',
            'En_caso_de_accidente',
            'Renta_veh_culo',
            'Vida',
            'ltimos_gastos',
            'Deducible',
            'Cruz_roja',
            'Cobertura_extra',
            'Cobertura_pink',
            'Gastos_m_dicos',
            'Vendor_Name',
            'P_liza',
            'Condiciones_certificado',
        ], $selectedLine->id_crm)['data'][0];

        $vendorCRM = app(ZohoCRMService::class)->getRecords('Vendors', [
            'Nombre',
            'Street',
            'Phone',
        ], $productCRM['Vendor_Name']['id'])['data'][0];

        $title = 'Certificado No. '.$quoteVehicle->id;

        $pdf = Pdf::loadView('quote-vehicles.download-certificate', [
            'productCRM' => $productCRM,
            'vendorCRM' => $vendorCRM,
            'quoteVehicle' => $quoteVehicle,
            'quote' => $quote,
            'selectedLine' => $selectedLine,
            'debtor' => $quote->debtor,
            'vehicle' => $quoteVehicle->vehicle,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }
}
