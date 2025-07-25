<?php

namespace App\Helpers;

use zcrmsdk\crm\crud\ZCRMInventoryLineItem;
use zcrmsdk\crm\crud\ZCRMRecord;
use zcrmsdk\crm\exception\ZCRMException;
use zcrmsdk\crm\setup\restclient\ZCRMRestClient;
use zcrmsdk\oauth\exception\ZohoOAuthException;
use zcrmsdk\oauth\ZohoOAuth;

class Zoho
{
    public function __construct()
    {
        $config = config('zoho');

        ZCRMRestClient::initialize([
            'client_id' => $config['oauth']['client_id'],
            'client_secret' => $config['oauth']['client_secret'],
            'currentUserEmail' => 'tecnologia@gruponobe.com',
            'redirect_uri' => $config['oauth']['redirect_uri'],
            'token_persistence_path' => base_path(),
        ]);
    }

    // total access scope
    // aaaserver.profile.READ,ZohoCRM.users.ALL,ZohoCRM.modules.ALL,ZohoCRM.settings.all,ZohoCRM.settings.fields.ALL
    /**
     * @throws ZohoOAuthException
     */
    public function generateTokens($grant_token)
    {
        $oAuthClient = ZohoOAuth::getClientInstance();
        $oAuthClient->generateAccessToken($grant_token);
    }

    public function generateTXTToken($refreshToken)
    {
        $oAuthClient = ZohoOAuth::getClientInstance();
        $userIdentifier = 'tecnologia@gruponobe.com';
        $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken, $userIdentifier);
    }

    public function getRecord($module_api_name, $record_id): ?object
    {
        $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance($module_api_name); // To get module instance
        $record = null;

        try {
            $response = $moduleIns->getRecord($record_id); // To get module record
            $record = $response->getData(); // To get response data
        } catch (ZCRMException $ex) {
            // echo $ex->getMessage(); // To get ZCRMException error message
            // echo $ex->getExceptionCode(); // To get ZCRMException error code
            // echo $ex->getFile(); // To get the file name that throws the Exception
        }

        return $record;
    }

    public function getAttachments($module_api_name, $record_id, $page = 1, $per_page = 200): ?array
    {
        $record = ZCRMRestClient::getInstance()->getRecordInstance($module_api_name, $record_id); // To get record instance
        $param_map = ['page' => $page, 'per_page' => $per_page]; // key-value pair containing all the parameters - optional
        $attachments = null;

        try {
            $responseIns = $record->getAttachments($param_map); // to get the attachments
            $attachments = $responseIns->getData(); // to get the attachments in form of ZCRMAttachment instance array
        } catch (ZCRMException $ex) {
            // echo $ex->getMessage(); // To get ZCRMException error message
            // echo $ex->getExceptionCode(); // To get ZCRMException error code
            // echo $ex->getFile(); // To get the file name that throws the Exception
        }

        return $attachments;
    }

    public function downloadAttachment($module_api_name, $record_id, $attachment_id, $filePath): string
    {
        $record = ZCRMRestClient::getInstance()->getRecordInstance($module_api_name, $record_id); // To get record instance

        $stream = '';
        try {
            $fileResponseIns = $record->downloadAttachment($attachment_id);
            $file = $filePath.'/'.$fileResponseIns->getFileName();
            $fp = fopen($file, 'w');
            // echo "HTTP Status Code:" . $fileResponseIns->getHttpStatusCode();
            // echo "File Name:" . $fileResponseIns->getFileName();
            $stream = $fileResponseIns->getFileContent();
            //            var_dump($stream);
            fwrite($fp, $stream);
            fclose($fp);
        } catch (ZCRMException $ex) {
            // echo $ex->getMessage(); // To get ZCRMException error message
            // echo $ex->getExceptionCode(); // To get ZCRMException error code
            // echo $ex->getFile(); // To get the file name that throws the Exception
        }

        return $stream;
    }

    public function searchRecordsByCriteria($module_api_name, $criteria, $page = 1, $per_page = 200): ?array
    {
        $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance($module_api_name); // To get module instance
        $param_map = ['page' => $page, 'per_page' => $per_page]; // key-value pair containing all the parameters
        $records = null;

        try {
            $response = $moduleIns->searchRecordsByCriteria($criteria, $param_map); // To get module records// $criteria to search for  to search for// $param_map-parameters key-value pair - optional
            $records = $response->getData(); // To get response data
        } catch (ZCRMException $ex) {
            // echo $ex->getMessage(); // To get ZCRMException error message
            // echo $ex->getExceptionCode(); // To get ZCRMException error code
            // echo $ex->getFile(); // To get the file name that throws the Exception
        }

        return $records;
    }

    /**
     * @throws ZCRMException
     */
    public function update($module_api_name, $record_id, $cambios)
    {
        $record = ZCRMRestClient::getInstance()->getRecordInstance($module_api_name, $record_id); // To get record instance

        foreach ($cambios as $campo => $valor) {
            $record->setFieldValue($campo, $valor); // This function use to set FieldApiName and value similar to all other FieldApis and Custom field
        }

        $responseIns = $record->update(); // to update the record
        // echo "HTTP Status Code:" . $responseIns->getHttpStatusCode(); // To get http response code
        // echo "Status:" . $responseIns->getStatus(); // To get response status
        // echo "Message:" . $responseIns->getMessage(); // To get response message
        // echo "Code:" . $responseIns->getCode(); // To get status code
        // echo "Details:" . json_encode($responseIns->getDetails());
    }

    public function createRecords($module_api_name, $registro, $planes)
    {
        $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance($module_api_name); // to get the instance of the module
        $records = [];

        $record = ZCRMRecord::getInstance($module_api_name, null);  // To get ZCRMRecord instance
        foreach ($registro as $campo => $valor) {
            $record->setFieldValue($campo, $valor); // This function use to set FieldApiName and value similar to all other FieldApis and Custom field
        }

        // recorre los planes/productos al registro
        foreach ($planes as $plan) {
            $lineItem = ZCRMInventoryLineItem::getInstance(null);
            $lineItem->setListPrice(round($plan['total'], 2));
            $lineItem->setProduct(ZCRMRecord::getInstance('Products', $plan['planid']));
            $lineItem->setQuantity(1);
            if (! empty($plan['monto_mantenimiento'])) {
                $lineItem->setDescription(
                    json_encode([
                        'monto_mantenimiento' => $plan['monto_mantenimiento'],
                    ])
                );
            }
            if (! empty($plan['prima_vida'])) {
                $lineItem->setDescription(
                    json_encode([
                        'prima_vida' => $plan['prima_vida'],
                        'prima_incendio' => $plan['prima_incendio'],
                    ])
                );
            }
            $record->addLineItem($lineItem);
        }

        $id = null;
        array_push($records, $record); // pushing the record to the array.
        $responseIn = $moduleIns->createRecords($records); // updating the records.$trigger,$lar_id are optional
        foreach ($responseIn->getEntityResponses() as $responseIns) {
            // echo "HTTP Status Code:" . $responseIn->getHttpStatusCode(); // To get http response code
            // echo "Status:" . $responseIns->getStatus(); // To get response status
            // echo "Message:" . $responseIns->getMessage(); // To get response message
            // echo "Code:" . $responseIns->getCode(); // To get status code
            // echo "Details:" . json_encode($responseIns->getDetails());
            $details = json_decode(json_encode($responseIns->getDetails()), true);
            $id = $details['id'];
        }

        return $id;
    }

    public function uploadAttachment($module_api_name, $record_id, $path)
    {
        $record = ZCRMRestClient::getInstance()->getRecordInstance($module_api_name, $record_id); // To get record instance
        $responseIns = $record->uploadAttachment($path); // $filePath - absolute path of the attachment to be uploaded.
        // echo "HTTP Status Code:" . $responseIns->getHttpStatusCode(); // To get http response code
        // echo "Status:" . $responseIns->getStatus(); // To get response status
        // echo "Message:" . $responseIns->getMessage(); // To get response message
        // echo "Code:" . $responseIns->getCode(); // To get status code
        // echo "Details:" . $responseIns->getDetails()['id'];
    }

    public function getRecords($module_api_name, $page = 1, $per_page = 200): ?array
    {
        $moduleIns = ZCRMRestClient::getInstance()->getModuleInstance($module_api_name);
        $param_map = ['page' => $page, 'per_page' => $per_page];
        $records = null;

        try {
            $response = $moduleIns->getRecords($param_map);
            $records = $response->getData();
        } catch (ZCRMException $ex) {
            // echo $ex->getMessage(); // To get ZCRMException error message
            // echo $ex->getExceptionCode(); // To get ZCRMException error code
            // echo $ex->getFile(); // To get the file name that throws the Exception
        }

        return $records;
    }

    /**
     * @throws ZCRMException
     */
    public function delete($module_api_name, $record_id)
    {
        $record = ZCRMRestClient::getInstance()->getRecordInstance($module_api_name, $record_id); // To get record instance
        $responseIns = $record->delete();
        // echo "HTTP Status Code:" . $responseIns->getHttpStatusCode(); // To get http response code
        // echo "Status:" . $responseIns->getStatus(); // To get response status
        // echo "Message:" . $responseIns->getMessage(); // To get response message
        // echo "Code:" . $responseIns->getCode(); // To get status code
        // echo "Details:" . json_encode($responseIns->getDetails());
    }
}
