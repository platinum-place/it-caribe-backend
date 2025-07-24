<?php

namespace App\Http\Controllers;

use App\Models\QuoteLife;
use App\Models\QuoteVehicle;
use App\Services\Api\Zoho\ZohoCRMService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteLifeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
    public function show(QuoteLife $quoteLife)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuoteLife $quoteLife)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteLife $quoteLife)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteLife $quoteLife)
    {
        //
    }

    public function download(QuoteLife $quoteLife)
    {
        $quote = $quoteLife->quote;

        $quoteCRM = app(ZohoCRMService::class)->getRecords('Quotes', [
            'Quote_Number',
            'Plan',
        ], $quoteLife->quote->id_crm)['data'][0];

        $title = 'Cotización No. '.$quoteCRM['Quote_Number'];

        $pdf = Pdf::loadView('quote-lives.download', [
            'quoteCRM' => $quoteCRM,
            'quoteLife' => $quoteLife,
            'quote' => $quote,
            'lines' => $quoteLife->lines,
            'customer' => $quote->customer,
            'coDebtor' => $quoteLife?->coDebtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }

    public function downloadCertificate(QuoteLife $quoteLife)
    {
        $quote = $quoteLife->quote;
        $selectedLine = $quote->selectedLine;

        $quoteCRM = app(ZohoCRMService::class)->getRecords('Quotes', [
            'Quote_Number',
            'Plan',
        ], $quote->id_crm)['data'][0];

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
        ], $selectedLine->id_crm)['data'][0];

        $vendorCRM = app(ZohoCRMService::class)->getRecords('Vendors', [
            'Nombre',
        ], $productCRM['Vendor_Name']['id'])['data'][0];

        $title = 'Certificado No. '.$quoteCRM['Quote_Number'];

        $pdf = Pdf::loadView('quote-lives.download-certificate', [
            'quoteCRM' => $quoteCRM,
            'productCRM' => $productCRM,
            'vendorCRM' => $vendorCRM,
            'quoteVehicle' => $quoteLife,
            'quote' => $quote,
            'selectedLine' => $selectedLine,
            'customer' => $quote->customer,
            'vehicle' => $quoteVehicle->vehicle,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }
}
