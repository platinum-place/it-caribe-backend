<?php

namespace Modules\DgiiIntegration\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Application\DTOs\CommercialApprovalDto;
use Modules\Common\Domain\Contracts\CommercialApprovalXmlInterface;
use Modules\Common\Domain\Contracts\DgiiApiClientInterface;
use Modules\Common\Domain\Contracts\SignCompanyDocumentInterface;
use Modules\Common\Domain\ValueObjects\Token;
use Modules\DgiiIntegration\Presentation\Http\Requests\XmlRequest;

class SendInvoiceController extends Controller
{
    public function __construct(
        protected DgiiApiClientInterface $apiClient,
        protected SignCompanyDocumentInterface $signCompanyDocument,
        protected CommercialApprovalXmlInterface $commercialApprovalXml,
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(XmlRequest $request, string $tenant)
    {
        $file = $request->file('xml');

        $xmlName = \Str::random();
        $xmlPath = 'companies/'.$tenant.'/xmls/'.now()->timestamp.'/'."$xmlName.xml";

        $path = $file->storeAs($xmlPath, $xmlName);

        $error = null;
        $status = null;

        try {
            $token = $request->bearerToken();
            $dgiiResponse = $this->apiClient->sendInvoice('testecf', $path, new Token($token));

            $status = 0;
        } catch (\Exception $exception) {
            $status = 1;
            $error = $exception->getMessage();
        }

        $xmlObject = simplexml_load_string($file->getContent());

        $document = $this->commercialApprovalXml->handle(
            new CommercialApprovalDto(
                (string) $xmlObject->Encabezado->Emisor->RNCEmisor,
                (string) $xmlObject->Encabezado->Comprador->RNCComprador,
                (string) $xmlObject?->Encabezado?->IdDoc?->eNCF,
                (string) $xmlObject?->Encabezado?->Totales?->MontoTotal,
                (string) $xmlObject?->Encabezado?->Emisor?->FechaEmision,
                $status,
                $error
            )
        );

        $filename = 'aprobacion-comercial';

        $signedXml = $this->signCompanyDocument->handle($tenant, $filename, $document);

        return response()->streamDownload(function () use ($signedXml) {
            echo $signedXml->content;
        }, $filename, ['Content-Type' => 'application/xml']);
    }
}
