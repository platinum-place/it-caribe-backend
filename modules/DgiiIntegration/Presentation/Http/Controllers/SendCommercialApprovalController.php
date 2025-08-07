<?php

namespace Modules\DgiiIntegration\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Domain\Contracts\DgiiApiClientInterface;
use Modules\Common\Domain\ValueObjects\Token;
use Modules\DgiiIntegration\Presentation\Http\Requests\XmlRequest;

class SendCommercialApprovalController extends Controller
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

        try {
            $token = $request->bearerToken();
            $dgiiResponse = $this->apiClient->sendCommercialApproval('testecf', $path, new Token($token));
        } catch (\Exception $exception) {

        }

        return response()->noContent(200);
    }
}
