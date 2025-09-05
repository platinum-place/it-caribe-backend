<?php

namespace Modules\Application\API\Zoho\UseCases;

use Modules\Domain\API\Zoho\Contracts\FetchZohoRecordInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoCRMInterface;

class FetchRecordsUseCase implements FetchZohoRecordInterface
{
    public function __construct(
        protected ZohoCRMInterface $zohoCRM,
        protected FetchAccessTokenUseCase $fetchAccessTokenUseCase,
    ) {
        //
    }

    public function handle(string $module, string $criteria): array
    {
        $token = $this->fetchAccessTokenUseCase->handle();

        return $this->zohoCRM->fetchRecordsByCriteria($module, $token->accessToken, $criteria);
    }
}
