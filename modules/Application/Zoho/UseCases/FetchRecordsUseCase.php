<?php

namespace Modules\Application\Zoho\UseCases;

use Modules\Application\Zoho\Contracts\FetchZohoRecordInterface;
use Modules\Domain\Zoho\Contracts\ZohoCRMInterface;

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
        $accessToken = $this->fetchAccessTokenUseCase->handle();

        return $this->zohoCRM->fetchRecordsByCriteria($module, $accessToken->accessToken, $criteria);
    }
}
