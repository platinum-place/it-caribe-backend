<?php

namespace App\Http\Controllers;

use App\Models\folder\QuoteLife;
use App\Services\Zoho\ZohoCRMService;
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

        $title = 'Cotización No. '.$quoteLife->id;

        $pdf = Pdf::loadView('quote-lives.download', [
            'quoteLife' => $quoteLife,
            'quote' => $quote,
            'lines' => $quoteLife->lines,
            'debtor' => $quote->debtor,
            'coDebtor' => $quoteLife?->coDebtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }

    public function downloadCertificate(QuoteLife $quoteLife)
    {
        $quote = $quoteLife->quote;
        $selectedLine = $quoteLife->selectedLine;

        $productCRM = app(ZohoCRMService::class)->getRecords('Products', [
            'Vendor_Name',
            'P_liza',
        ], $selectedLine->quoteLine->id_crm)['data'][0];

        $vendorCRM = app(ZohoCRMService::class)->getRecords('Vendors', [
            'Nombre',
            'Street',
            'Phone',
        ], $productCRM['Vendor_Name']['id'])['data'][0];

        $title = 'Certificado No. '.$quoteLife->id;

        $pdf = Pdf::loadView('quote-lives.download-certificate', [
            'vendorCRM' => $vendorCRM,
            'productCRM' => $productCRM,
            'quoteLife' => $quoteLife,
            'quote' => $quote,
            'selectedLine' => $selectedLine,
            'debtor' => $quote->debtor,
            'coDebtor' => $quoteLife?->coDebtor,
            'title' => $title,
        ]);

        return $pdf->stream("$title.pdf");
    }
}
