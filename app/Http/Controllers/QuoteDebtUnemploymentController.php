<?php

namespace App\Http\Controllers;

use App\Models\QuoteDebtUnemployment;
use App\Services\Api\Zoho\ZohoCRMService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteDebtUnemploymentController extends Controller
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
    public function show(QuoteDebtUnemployment $quoteDebtUnemployment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteDebtUnemployment $quoteDebtUnemployment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteDebtUnemployment $quoteDebtUnemployment)
    {
        //
    }

    public function download(QuoteDebtUnemployment $quoteDebtUnemployment)
    {
        $quote = $quoteDebtUnemployment->quote;

        $title = 'Cotización No. '.$quoteDebtUnemployment->id;

        $pdf = Pdf::loadView('quote-debt-unemployment.download', [
            'quoteDebtUnemployment' => $quoteDebtUnemployment,
            'quote' => $quote,
            'lines' => $quoteDebtUnemployment->lines,
            'debtor' => $quote->debtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }

    public function downloadCertificate(QuoteDebtUnemployment $quoteDebtUnemployment)
    {
        $quote = $quoteDebtUnemployment->quote;
        $selectedLine = $quoteDebtUnemployment->selectedLine;

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

        $title = 'Certificado No. '.$quoteDebtUnemployment->id;

        $pdf = Pdf::loadView('quote-debt-unemployment.download-certificate', [
            'vendorCRM' => $vendorCRM,
            'productCRM' => $productCRM,
            'quoteDebtUnemployment' => $quoteDebtUnemployment,
            'quote' => $quote,
            'selectedLine' => $selectedLine,
            'debtor' => $quote->debtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }
}
