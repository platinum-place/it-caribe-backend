<?php

return [
    'timeout' => env('ZOHO_TIMEOUT', 30),
    'retry_attempts' => env('ZOHO_RETRY_ATTEMPTS', 3),
    'retry_delay' => env('ZOHO_RETRY_DELAY', 1000),
    'rate_limit_per_minute' => env('ZOHO_RATE_LIMIT', 100),

    'oauth' => [
        'domain' => env('ZOHO_OAUTH_DOMAIN', 'https://accounts.zoho.com'),

        'credentials' => [
            'client_id' => env('ZOHO_CLIENT_ID'),
            'client_secret' => env('ZOHO_CLIENT_SECRET'),
            'redirect_uri' => env('ZOHO_REDIRECT_URI'),
        ],

        'endpoints' => [
            'token' => env('ZOHO_TOKEN_ENDPOINT', 'oauth/v2/token'),
            'authorize' => env('ZOHO_AUTHORIZE_ENDPOINT', 'oauth/v2/auth'),
            'refresh' => env('ZOHO_REFRESH_ENDPOINT', 'oauth/v2/token'),
        ],

        'scopes' => [
            'crm' => 'ZohoCRM.modules.ALL,ZohoCRM.settings.ALL',
            'default' => env('ZOHO_DEFAULT_SCOPE', 'ZohoCRM.modules.READ'),
        ],
    ],

    'api' => [
        'domain' => env('ZOHO_API_DOMAIN', 'https://www.zohoapis.com'),

        'versions' => [
            'crm' => env('ZOHO_CRM_VERSION', 'crm/v8'),
            'books' => env('ZOHO_BOOKS_VERSION', 'books/v3'),
            'desk' => env('ZOHO_DESK_VERSION', 'desk/v1'),
        ],

        'endpoints' => [
            'crm' => [
                'leads' => 'Leads',
                'contacts' => 'Contacts',
                'accounts' => 'Accounts',
                'deals' => 'Deals',
                'tasks' => 'Tasks',
                'calls' => 'Calls',
                'events' => 'Events',
            ],
        ],

        'pagination' => [
            'page' => env('ZOHO_PAGINATION_PAGE', 1),
            'per_page' => env('ZOHO_PAGINATION_PER_PAGE', 200),
        ],
    ],
];
