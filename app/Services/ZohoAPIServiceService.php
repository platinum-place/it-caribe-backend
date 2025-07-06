<?php

namespace App\Services;

use App\Contracts\Services\ZohoAPIServiceContract;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ZohoAPIServiceService implements ZohoAPIServiceContract
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getTemporaryToken(string $clientId, string $clientSecret, string $refreshToken): array
    {
        $url = config('zoho.domains.accounts_url').'/'.config('zoho.oauth.uri');

        return Http::asForm()
            ->post($url, [
                'grant_type' => 'refresh_token',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'refresh_token' => $refreshToken,
            ])
            ->throw()
            ->json();
    }
}
