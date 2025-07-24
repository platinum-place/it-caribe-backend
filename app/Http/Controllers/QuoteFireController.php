<?php

namespace App\Http\Controllers;

use App\Models\QuoteFire;
use App\Models\QuoteLife;
use App\Services\Api\Zoho\ZohoCRMService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteFireController extends Controller
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
    public function show(QuoteFire $quoteFire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteFire $quoteFire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteFire $quoteFire)
    {
        //
    }

    public function download(QuoteFire $quoteFire)
    {
        $quote = $quoteLife->quote;

        $quoteCRM = app(ZohoCRMService::class)->getRecords('Quotes', [
            'Quote_Number',
            'Plan',
        ], $quoteLife->quote->id_crm)['data'][0];

        $title = 'Cotización No. '.$quoteCRM['Quote_Number'];

        $pdf = Pdf::loadView('quote-fires.download', [
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

    public function downloadCertificate(QuoteFire $quoteFire)
    {
        $quote = $quoteFire->quote;
        $selectedLine = $quoteFire->selectedLine;

        $quoteCRM = app(ZohoCRMService::class)->getRecords('Quotes', [
            'Quote_Number',
            'Plan',
        ], $quote->id_crm)['data'][0];

        $productCRM = app(ZohoCRMService::class)->getRecords('Products', [
            'Vendor_Name',
            'P_liza',
        ], $selectedLine->quoteLine->id_crm)['data'][0];

        $vendorCRM = app(ZohoCRMService::class)->getRecords('Vendors', [
            'Nombre',
            'Street',
            'Phone',
        ], $productCRM['Vendor_Name']['id'])['data'][0];

        $title = 'Cotización No. '.$quoteCRM['Quote_Number'];

        $pdf = Pdf::loadView('quote-fires.download-certificate', [
            'vendorCRM' => $vendorCRM,
            'productCRM' => $productCRM,
            'quoteCRM' => $quoteCRM,
            'quoteFire' => $quoteFire,
            'quote' => $quote,
            'selectedLine' => $selectedLine,
            'customer' => $quote->customer,
            'coDebtor' => $quoteFire?->coDebtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }
}
