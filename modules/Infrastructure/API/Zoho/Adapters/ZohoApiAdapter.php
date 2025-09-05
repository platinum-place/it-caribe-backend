<?php

namespace Modules\Infrastructure\API\Zoho\Adapters;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Modules\Domain\API\Zoho\Contracts\ZohoCRMInterface;

class ZohoApiAdapter implements ZohoCRMInterface
{
    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchRefreshToken(string $grantToken): array
    {
        $url = config('zoho.oauth.domain').'/'.config('zoho.oauth.endpoints.token');

        $response = Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->asForm()
            ->post($url, [
                'grant_type' => 'authorization_code',
                'client_id' => config('zoho.oauth.credentials.client_id'),
                'client_secret' => config('zoho.oauth.credentials.client_secret'),
                'redirect_uri' => config('zoho.oauth.credentials.redirect_uri'),
                'code' => $grantToken,
            ])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException('Zoho OAuth Error: '.$response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchAccessToken(string $refreshToken): array
    {
        $url = config('zoho.oauth.domain').'/'.config('zoho.oauth.endpoints.refresh');

        $response = Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->asForm()
            ->post($url, [
                'grant_type' => 'refresh_token',
                'client_id' => config('zoho.oauth.credentials.client_id'),
                'client_secret' => config('zoho.oauth.credentials.client_secret'),
                'refresh_token' => $refreshToken,
            ])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException('Zoho Token Refresh Error: '.$response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchRecordsByCriteria(string $module, string $token, string $criteria, ?int $page = null, ?int $perPage = null): ?array
    {
        $page = $page ?? (int)config('zoho.api.pagination.page');
        $perPage = $perPage ??(int) config('zoho.api.pagination.per_page');
        $crmVersion = config('zoho.api.versions.crm');
        $url = sprintf('%s/%s/%s/search', config('zoho.api.domain'), $crmVersion, $module);

        $response = Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->withToken($token, 'Zoho-oauthtoken')
            ->get($url, [
                'criteria' => $criteria,
                'page' => $page,
                'per_page' => min($perPage, config('zoho.api.pagination.max_per_page')),
            ])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException('Zoho Search Error: '.$response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchRecords(string $module, string $token, array $fields, ?string $id = ''): array
    {
        $crmVersion = config('zoho.api.versions.crm');
        $url = sprintf('%s/%s/%s%s', config('zoho.api.domain'), $crmVersion, $module, $id ? "/$id" : '');

        $response = Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->withToken($token, 'Zoho-oauthtoken')
            ->get($url, [
                'fields' => implode(',', $fields),
            ])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException('Zoho Fetch Records Error: '.$response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getListOfAttachments(string $module, string $token, string $id, array $fields): ?array
    {
        $crmVersion = config('zoho.api.versions.crm');
        $url = sprintf('%s/%s/%s/%s/Attachments', config('zoho.api.domain'), $crmVersion, $module, $id);

        $response = Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->withToken($token, 'Zoho-oauthtoken')
            ->get($url, ['fields' => implode(',', $fields)])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException('Zoho Attachments Error: '.$response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function downloadAnAttachment(string $module, string $token, string $recordId, string $attachmentId): string
    {
        $crmVersion = config('zoho.api.versions.crm');
        $url = sprintf('%s/%s/%s/%s/Attachments/%s', config('zoho.api.domain'), $crmVersion, $module, $recordId, $attachmentId);

        return Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->withToken($token, 'Zoho-oauthtoken')
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
        $crmVersion = config('zoho.api.versions.crm');
        $url = sprintf('%s/%s/%s', config('zoho.api.domain'), $crmVersion, $module);

        $response = Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->withToken($token, 'Zoho-oauthtoken')
            ->post($url, ['data' => $data])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException('Zoho Insert Records Error: '.$response['error']);
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function updateRecords(string $module, string $token, string $id, array $data): ?array
    {
        $crmVersion = config('zoho.api.versions.crm');
        $url = sprintf('%s/%s/%s/%s', config('zoho.api.domain'), $crmVersion, $module, $id);

        $response = Http::timeout(config('zoho.timeout'))
            ->retry(config('zoho.retry_attempts'), config('zoho.retry_delay'))
            ->withUserAgent(config('zoho.user_agent'))
            ->withToken($token, 'Zoho-oauthtoken')
            ->put($url, ['data' => $data])
            ->throw()
            ->json();

        if (isset($response['error'])) {
            throw new \RuntimeException('Zoho Update Records Error: '.$response['error']);
        }

        return $response;
    }
}
