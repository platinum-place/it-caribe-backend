<?php

namespace App\Services\Api\Zoho;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ZohoAPIService
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getPersistentToken(string $grantToken): array
    {
        return Http::asForm()
            ->post(config('zoho.domains.accounts_url').'/'.config('zoho.oauth.uri'), [
                'grant_type' => 'authorization_code',
                'client_id' => config('zoho.oauth.client_id'),
                'client_secret' => config('zoho.oauth.client_secret'),
                'redirect_uri' => config('zoho.oauth.redirect_uri'),
                'code' => $grantToken,
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getTemporaryToken(string $refreshToken): array
    {
        return Http::asForm()
            ->post(config('zoho.domains.accounts_url').'/'.config('zoho.oauth.uri'), [
                'grant_type' => 'refresh_token',
                'client_id' => config('zoho.oauth.client_id'),
                'client_secret' => config('zoho.oauth.client_secret'),
                'refresh_token' => $refreshToken,
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function searchRecords(string $module, string $token, string $criteria, int $page = 1, int $perPage = 200): ?array
    {
        $url = sprintf('%s/%s/search', config('zoho.domains.api').'/'.config('zoho.crm.uri'), $module);

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
        $url = sprintf('%s/%s%s', config('zoho.domains.api').'/'.config('zoho.crm.uri'), $module, $id ? "/$id" : '');

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
        $url = sprintf('%s/%s/%s/Attachments', config('zoho.domains.api').'/'.config('zoho.crm.uri'), $module, $id);

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
        $url = sprintf('%s/%s/%s/Attachments/%s', config('zoho.domains.api').'/'.config('zoho.crm.uri'), $module, $recordId, $attachmentId);

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
        $url = sprintf('%s/%s', config('zoho.domains.api').'/'.config('zoho.crm.uri'), $module);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->post($url, [
                'data' => $data,
            ])
            ->throw()
            ->json();
    }
}
