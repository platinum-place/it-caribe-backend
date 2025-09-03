<?php

namespace Modules\Application\Common\UseCases;

use Modules\Application\Common\Contracts\FetchZohoRecordInterface;
use Modules\Domain\Common\Contracts\ZohoCRMInterface;

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
