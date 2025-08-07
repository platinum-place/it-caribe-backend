<?php

namespace Modules\DgiiIntegration\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Domain\Contracts\DgiiApiClientInterface;
use Modules\DgiiIntegration\Presentation\Http\Requests\XmlRequest;

class FetchTokenController extends Controller
{
    public function __construct(protected DgiiApiClientInterface $apiClient) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(XmlRequest $request, string $tenant)
    {
        $file = $request->file('xml');

        $xmlName = \Str::random();
        $xmlPath = 'companies/'.$tenant.'/xmls/'.now()->timestamp.'/'."$xmlName.xml";

        $path = $file->storeAs($xmlPath, $xmlName);

        $xmlContent = $this->apiClient->fetchToken('testecf', $path);

        return response()->streamDownload(function () use ($xmlContent) {
            echo json_encode($xmlContent->response, JSON_THROW_ON_ERROR);
        }, "$xmlName.xml", ['Content-Type' => 'application/xml']);
    }
}
