<?php

namespace Modules\Infrastructure\Common\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ZohoApiClient
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchRefreshToken(string $grantToken, string $clientId, string $clientSecret, string $redirectUri): array
    {
        $response = Http::asForm()
            ->post(config('zoho.domains.accounts').'/'.config('zoho.uri.oauth').'/token', [
                'grant_type' => 'authorization_code',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri' => $redirectUri,
                'code' => $grantToken,
            ])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException($response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchAccessToken(string $refreshToken, string $clientId, string $clientSecret): array
    {
        $response = Http::asForm()
            ->post(config('zoho.domains.accounts').'/'.config('zoho.uri.oauth').'/token', [
                'grant_type' => 'refresh_token',
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'refresh_token' => $refreshToken,
            ])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException($response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function searchRecords(string $module, string $token, string $criteria, int $page = 1, int $perPage = 200): ?array
    {
        $url = sprintf('%s/%s/search', config('zoho.domains.api').'/'.config('zoho.c'), $module);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->get($url, http_build_query([
                'criteria' => $criteria,
                'page' => $page,
                'per_page' => $perPage,
            ]))
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getRecords(string $module, string $token, array $fields, ?string $id = ''): ?array
    {
        $url = sprintf('%s/%s%s', config('zoho.domains.api').'/'.config('zoho.uri.crm'), $module, $id ? "/$id" : '');

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->get($url, [
                'fields' => implode(',', $fields),
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getListOfAttachments(string $module, string $token, string $id, array $fields): ?array
    {
        $url = sprintf('%s/%s/%s/Attachments', config('zoho.domains.api').'/'.config('zoho.uri.crm'), $module, $id);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->get($url, ['fields' => implode(',', $fields)])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function downloadAnAttachment(string $module, string $token, string $recordId, string $attachmentId): string
    {
        $url = sprintf('%s/%s/%s/Attachments/%s', config('zoho.domains.api').'/'.config('zoho.uri.crm'), $module, $recordId, $attachmentId);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->get($url)
            ->throw()
            ->body();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function insertRecords(string $module, string $token, array $data): ?array
    {
        $url = sprintf('%s/%s', config('zoho.domains.api').'/'.config('zoho.uri.crm'), $module);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->post($url, [
                'data' => $data,
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function updateRecords(string $module, string $token, string $id, array $data): ?array
    {
        $url = sprintf('%s/%s/%s', config('zoho.domains.api').'/'.config('zoho.uri.crm'), $module, $id);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->put($url, [
                'data' => $data,
            ])
            ->throw()
            ->json();
    }
}
