<?php

namespace App\Contracts\Services;

use App\Models\ZohoOauthAccessToken;

interface ZohoServiceContract
{
    public function getAccessToken(): ?ZohoOauthAccessToken;
}
