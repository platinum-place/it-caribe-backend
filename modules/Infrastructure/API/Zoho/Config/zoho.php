<?php

return [
    'credentials' => [
        'client_id' => env('API_ZOHO_CLIENT_ID'),
        'client_secret' => env('API_ZOHO_CLIENT_SECRECT'),
        'redirect_uri' => env('API_ZOHO_REDIRECT_URI'),
    ],

    'domains' => [
        'accounts' => 'https://accounts.zoho.com',
        'api' => 'https://www.zohoapis.com',
    ],

    'uri' => [
        'crm' => 'crm/v8',
        'oauth' => 'oauth/v2',
    ],
];
