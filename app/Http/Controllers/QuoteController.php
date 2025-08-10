<?php

namespace App\Http\Controllers;

use App\Services\Api\Zoho\ZohoCRMService;
use Illuminate\Http\Request;
use Modules\Quote\Infrastructure\Persistance\Models\Quote;

class QuoteController extends Controller
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
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        //
    }

    public function downloadCRMDocuments(Request $request, string $id)
    {
        $attachmentsResponse = app(ZohoCRMService::class)->getListOfAttachments('Products', $id, ['id']);

        $attachmentId = $attachmentsResponse['data'][0]['id'];

        $response = app(ZohoCRMService::class)->downloadAnAttachment('Products', $id, $attachmentId);

        $filaPath = "zoho/products/$id/".now()->timestamp.'.pdf';

        \Storage::put($filaPath, $response);

        return \Storage::download($filaPath);
    }
}
