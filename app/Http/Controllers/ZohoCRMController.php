<?php

namespace App\Http\Controllers;

use App\Helpers\Zoho;
use App\Services\Api\Zoho\ZohoCRMService;
use Illuminate\Http\Request;
use Zoho\API\CRM;
use Symfony\Component\Mime\MimeTypes;

class ZohoCRMController extends Controller
{
    public function downloadProductAttachments(Request $request, string $id)
    {
        $attachmentsResponse = app(ZohoCRMService::class)->getListOfAttachments('Products', $id, ['id']);

        $attachmentId = $attachmentsResponse['data'][0]['id'];

        $response = app(ZohoCRMService::class)->downloadAnAttachment('Products', $id, $attachmentId);

        $filaPath = "zoho/products/$id/" . now()->timestamp . '.pdf';

        \Storage::put($filaPath, $response);

        return \Storage::download($filaPath);
    }
}
