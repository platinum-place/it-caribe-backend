<?php

namespace App\Http\Controllers;

use App\Helpers\Zoho;
use App\Services\ZohoCRMService;
use Illuminate\Http\Request;
use Zoho\API\CRM;

class ZohoCRMController extends Controller
{
    public function downloadProductAttachments(Request $request, string $id)
    {
        $libreria = new Zoho;
        $attachments = $libreria->getAttachments('Products', $id);
        $file = $libreria->downloadAttachment('Products', $id, $attachments[0]->getId(), storage_path('app/private'));

        return response()->streamDownload(function () use ($file) {
            echo $file;
        }, 'Condicionado.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="Condicionado.pdf"',
        ]);
    }
}
