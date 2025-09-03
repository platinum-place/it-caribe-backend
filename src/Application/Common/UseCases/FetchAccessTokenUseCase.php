<?php

namespace Modules\Application\Common\UseCases;

use Modules\Domain\Common\Contracts\ZohoCRMInterface;
use Modules\Domain\Common\Entities\ZohoOauthAccessTokenEntity;
use Modules\Domain\Common\Repositories\ZohoOauthAccessTokenRepositoryInterface;

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
