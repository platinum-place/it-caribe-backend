<?php

namespace Modules\Application\Zoho\UseCases;

use Modules\Domain\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\Zoho\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Zoho\Repositories\ZohoOauthAccessTokenRepositoryInterface;

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
            return $this->oauthAccessTokenRepository->findLast();
        } catch (\Exception $e) {
            return $this->createAccessTokenUseCase->handle();
        }
    }
}
