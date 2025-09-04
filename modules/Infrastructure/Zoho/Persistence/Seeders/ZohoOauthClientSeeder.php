<?php

namespace Modules\Infrastructure\Zoho\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Modules\Infrastructure\Zoho\Persistence\Models\ZohoOauthClient;

class ZohoOauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'client_id' => '1000.7FJQ4A2KDH9S2IJWDYL13HATQFMA2H',
            'client_secret' => 'c3f1d0589803f294a7c5b27e3968ae1658927da9d7',
            'redirect_uri' => 'http://localhost/',
        ];

        ZohoOauthClient::create($data);
    }
}
