<?php

namespace Modules\Zoho\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Zoho\Models\ZohoOauthRefreshToken;

class ZohoOauthRefreshTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'refresh_token' => '1000.bae5c9af50ab70fb2896e07f6f1a6e89.181a3e49b7bf80546ae9094be389f6b1',
        ];

        ZohoOauthRefreshToken::create($data);
    }
}
