<?php

namespace App\Http\Controllers;

use App\Models\QuoteFire;
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
        $quote = $quoteFire->quote;

        $title = 'Cotización No. '.$quoteFire->id;

        $pdf = Pdf::loadView('quote-fires.download', [
            'quoteFire' => $quoteFire,
            'quote' => $quote,
            'lines' => $quoteFire->lines,
            'debtor' => $quote->debtor,
            'coDebtor' => $quoteFire?->coDebtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }

    public function downloadCertificate(QuoteFire $quoteFire)
    {
        $quote = $quoteFire->quote;
        $selectedLine = $quoteFire->selectedLine;

        $productCRM = app(ZohoCRMService::class)->getRecords('Products', [
            'Vendor_Name',
            'P_liza',
        ], $selectedLine->quoteLine->id_crm)['data'][0];

        $vendorCRM = app(ZohoCRMService::class)->getRecords('Vendors', [
            'Nombre',
            'Street',
            'Phone',
        ], $productCRM['Vendor_Name']['id'])['data'][0];

        $title = 'Certificado No. '.$quoteFire->id;

        $pdf = Pdf::loadView('quote-fires.download-certificate', [
            'vendorCRM' => $vendorCRM,
            'productCRM' => $productCRM,
            'quoteFire' => $quoteFire,
            'quote' => $quote,
            'selectedLine' => $selectedLine,
            'debtor' => $quote->debtor,
            'coDebtor' => $quoteFire?->coDebtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }
}
