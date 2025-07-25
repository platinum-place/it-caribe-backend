<?php

namespace Zoho\API;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CRM
{
    protected function getApiUrl(): string
    {
        return config('zoho.domains.api').'/'.config('zoho.crm.uri');
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getRecords(string $module, string $token, array $fields, ?string $id = ''): ?array
    {
        $url = sprintf('%s/%s%s', $this->getApiUrl(), $module, $id ? "/$id" : '');

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
    public function searchRecords(string $module, string $token, string $criteria, int $page = 1, int $perPage = 200): ?array
    {
        $url = sprintf('%s/%s/search', $this->getApiUrl(), $module);

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
    public function updateRecords(string $module, string $token, string $id, array $data): ?array
    {
        $url = sprintf('%s/%s/%s', $this->getApiUrl(), $module, $id);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->put($url, [
                'data' => [$data],
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function uploadAttachment(string $module, string $token, string $id, string $file): ?array
    {
        $url = sprintf('%s/%s/%s/Attachments', $this->getApiUrl(), $module, $id);

        $contents = fopen(Storage::path($file), 'rb');

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->attach('file', $contents)
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function attachmentList(string $module, string $token, string $id, array $fields): ?array
    {
        $url = sprintf('%s/%s/%s/Attachments', $this->getApiUrl(), $module, $id);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->get($url, ['fields' => implode(',', $fields)])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getAttachment(string $module, string $token, string $id, string $attachmentId): string
    {
        $url = sprintf('%s/%s/%s/Attachments/%s', $this->getApiUrl(), $module, $id, $attachmentId);

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
        $url = sprintf('%s/%s', $this->getApiUrl(), $module);

        return Http::withToken($token, 'Zoho-oauthtoken')
            ->post($url, [
                'data' => [$data],
            ])
            ->throw()
            ->json();
    }
}
