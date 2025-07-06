<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ZohoServiceContract;
use App\Http\Resources\ZohoOauthAccessTokenResource;

class ZohoServiceController extends Controller
{
    public function __construct(protected ZohoServiceContract $contract) {}

    public function generateToken()
    {
        $accessToken = $this->contract->generateAccessToken();

        return new ZohoOauthAccessTokenResource($accessToken);
    }

    public function token()
    {
        $accessToken = $this->contract->getAccessToken();

        if (! $accessToken) {
            abort(404);
        }

        return new ZohoOauthAccessTokenResource($accessToken);
    }
}
