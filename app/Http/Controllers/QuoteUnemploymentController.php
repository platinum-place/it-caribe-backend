<?php

namespace App\Http\Controllers;

use App\Models\QuoteUnemployment;
use App\Services\Api\Zoho\ZohoCRMService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteUnemploymentController extends Controller
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
    public function show(QuoteUnemployment $quoteUnemployment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteUnemployment $quoteUnemployment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteUnemployment $quoteUnemployment)
    {
        //
    }

    public function download(QuoteUnemployment $quoteUnemployment)
    {
        $quote = $quoteUnemployment->quote;

        $title = 'Cotización No. '.$quoteUnemployment->id;

        $pdf = Pdf::loadView('quote-unemployments.download', [
            'quoteUnemployment' => $quoteUnemployment,
            'quote' => $quote,
            'lines' => $quoteUnemployment->lines,
            'debtor' => $quote->debtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }

    public function downloadCertificate(QuoteUnemployment $quoteUnemployment)
    {
        $quote = $quoteUnemployment->quote;
        $selectedLine = $quoteUnemployment->selectedLine;

        $productCRM = app(ZohoCRMService::class)->getRecords('Products', [
            'Vendor_Name',
            'P_liza',
            'Condiciones_certificado',
        ], $selectedLine->quoteLine->id_crm)['data'][0];

        $vendorCRM = app(ZohoCRMService::class)->getRecords('Vendors', [
            'Nombre',
            'Street',
            'Phone',
        ], $productCRM['Vendor_Name']['id'])['data'][0];

        $title = 'Certificado No. '.$quoteUnemployment->id;

        $pdf = Pdf::loadView('quote-unemployments.download-certificate', [
            'vendorCRM' => $vendorCRM,
            'productCRM' => $productCRM,
            'quoteUnemployment' => $quoteUnemployment,
            'quote' => $quote,
            'selectedLine' => $selectedLine,
            'debtor' => $quote->debtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }
}
