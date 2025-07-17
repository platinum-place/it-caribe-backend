<?php

namespace App\Http\Controllers;

use App\Helpers\Zoho;
use App\Models\Quotes\QuoteVehicle;
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
        $libreria = new Zoho;
        $cotizacion = $libreria->getRecord('Quotes', $quoteVehicle->quote->id_crm);

        $pdf = Pdf::loadView('quote-vehicles.download', [
            'quoteVehicle' => $quoteVehicle,
            'cotizacion' => $cotizacion,
            'libreria' => $libreria,
            'name' => 'Cotización No. ' . $cotizacion->getFieldValue('Quote_Number'),
        ]);

        return $pdf->stream('Cotización No' . $cotizacion->getFieldValue('Quote_Number') . '.pdf');
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
