<?php

namespace old\Services\Zoho;

use app\Client\ZohoApiClient;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class ZohoService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected ZohoOauthService $oauth, protected ZohoApiClient $api)
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function searchRecords(string $module, string $criteria, ?int $page = 1, ?int $perPage = 200): ?array
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->searchRecords($module, $token->access_token, $criteria, $page, $perPage);

        if (empty($response) || empty($response['data'])) {
            throw new \RuntimeException(__('Records not found in Zoho'));
        }

        return $response;
    }

    public function getRecords(string $module, array $fields, ?string $id = ''): ?array
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->getRecords($module, $token->access_token, $fields, $id);

        if (empty($response) || empty($response['data'])) {
            throw new \RuntimeException(__('Records not found in Zoho'));
        }

        return $response;
    }
}
