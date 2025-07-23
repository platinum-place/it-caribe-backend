<?php

namespace App\Http\Controllers;

use App\Helpers\Zoho;
use App\Models\QuoteVehicle;
use App\Services\Api\Zoho\ZohoCRMService;
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
        $quoteCRM = app(ZohoCRMService::class)->getRecords('Quotes', [
            'Quote_Number',
            'Plan',
        ], $quoteVehicle->quote->id_crm)['data'][0];

        $pdf = Pdf::loadView('quote-vehicles.download', [
            'quoteCRM' => $quoteCRM,
            'quoteVehicle' => $quoteVehicle,
            'quote' => $quoteVehicle->quote,
            'lines' => $quoteVehicle->quote->lines,
            'customer' => $quoteVehicle->quote->customer,
            'vehicle' => $quoteVehicle->vehicle,
            'title' => 'Cotización No. '.$quoteCRM['Quote_Number'],
        ]);

        return $pdf->stream('Cotización No'.$quoteCRM['Quote_Number'].'.pdf');
    }

    public function downloadCertificate(QuoteVehicle $quoteVehicle)
    {
        $libreria = new Zoho;
        $cotizacion = $libreria->getRecord('Quotes', $quoteVehicle->quote->id_crm);
        $plan = $libreria->getRecord('Products', $cotizacion->getFieldValue('Coberturas')->getEntityId());
        $aseguradora = $libreria->getRecord('Vendors', $plan->getFieldValue('Vendor_Name')->getEntityId());

        $pdf = Pdf::loadView('quote-vehicles.download-certificate', [
            'quoteVehicle' => $quoteVehicle,
            'cotizacion' => $cotizacion,
            'plan' => $plan,
            'libreria' => $libreria,
            'aseguradora' => $aseguradora,
            'name' => 'Cotización No. '.$cotizacion->getFieldValue('Quote_Number'),
        ]);

        return $pdf->stream('Cotización No'.$cotizacion->getFieldValue('Quote_Number').'.pdf');
    }
}
