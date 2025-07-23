<?php

namespace App\Services\Api\Zoho;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class ZohoCRMService
{
    public function __construct(protected ZohoOAuthTokenService $oauth, protected ZohoAPIService $api) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function searchRecords(string $module, string $criteria, ?int $page = 1, ?int $perPage = 200): ?array
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->searchRecords($module, $token, $criteria, $page, $perPage);

        if (empty($response) || empty($response['data'])) {
            throw new Exception(__('Records not found in Zoho'));
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function getRecords(string $module, array $fields, ?string $id = ''): ?array
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->getRecords($module, $token, $fields, $id);

        if (empty($response) || empty($response['data'])) {
            throw new Exception(__('Records not found in Zoho'));
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function getListOfAttachments(string $module, string $id, array $fields): ?array
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->getListOfAttachments($module, $token, $id, $fields);

        if (empty($response) || empty($response['data'])) {
            throw new Exception(__('Records not found in Zoho'));
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function downloadAnAttachment(string $module, string $recordId, string $attachmentId): string
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->downloadAnAttachment($module, $token, $recordId, $attachmentId);

        if (empty($response)) {
            throw new Exception(__('Records not found in Zoho'));
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function insertRecords(string $module, array $data): ?array
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->insertRecords($module, $token, [$data]);

        if (empty($response)) {
            throw new Exception(__('Server Error'));
        }

        return $response;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function updateRecords(string $module, string $id, array $data): ?array
    {
        $token = $this->oauth->getAccessToken();

        $response = $this->api->updateRecords($module, $token, $id, [$data]);

        if (empty($response)) {
            throw new Exception(__('Server Error'));
        }

        return $response;
    }
}
