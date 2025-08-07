<?php

namespace Modules\DgiiIntegration\Presentation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Domain\Contracts\DgiiApiClientInterface;

class FetchSeedController extends Controller
{
    public function __construct(protected DgiiApiClientInterface $apiClient) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $xmlContent = $this->apiClient->fetchSeed('testecf');

        return response()->streamDownload(function () use ($xmlContent) {
            echo $xmlContent;
        }, now()->timestamp.'.xml', ['Content-Type' => 'application/xml']);
    }
}
