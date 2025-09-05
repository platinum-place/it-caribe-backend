<?php

namespace Modules\Application\API\Zoho\UseCases;

use Modules\Domain\API\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Entities\ZohoOauthAccessTokenEntity;

class FetchAccessTokenUseCase
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ZohoCRMInterface $zohoCRM,
        protected ZohoOauthAccessTokenRepositoryInterface $oauthAccessTokenRepository,
        protected CreateAccessTokenUseCase $createAccessTokenUseCase,
    ) {
        //
    }

    public function handle(): ZohoOauthAccessTokenEntity
    {
        try {
            return $this->oauthAccessTokenRepository->fetchMostRecent();
        } catch (\Exception $e) {
            return $this->createAccessTokenUseCase->handle();
        }
    }
}
