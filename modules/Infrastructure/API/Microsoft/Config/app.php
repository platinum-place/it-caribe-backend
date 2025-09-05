<?php

return [
    'timeout' => env('MICROSOFT_TIMEOUT', 30),
    'retry_attempts' => env('MICROSOFT_RETRY_ATTEMPTS', 3),
    'retry_delay' => env('MICROSOFT_RETRY_DELAY', 1000),
    'user_agent' => env('APP_NAME', 'Laravel') . '/' . env('APP_VERSION', '1.0'),
    'response_type' => 'code',
    'response_mode' => 'query',

    'oauth' => [
        'domain' => env('MICROSOFT_OAUTH_DOMAIN', 'https://login.microsoftonline.com'),

        'credentials' => [
            'client_id' => env('MICROSOFT_CLIENT_ID'),
            'client_secret' => env('MICROSOFT_CLIENT_SECRET'),
            'tenant_id' => env('MICROSOFT_TENANT_ID'),
            'redirect_uri' => env('MICROSOFT_REDIRECT_URI'),
        ],

        'endpoints' => [
            'token' => env('MICROSOFT_TOKEN_ENDPOINT', 'oauth2/v2.0/token'),
            'authorize' => env('MICROSOFT_AUTHORIZE_ENDPOINT', 'oauth2/v2.0/authorize'),
            'logout' => env('MICROSOFT_LOGOUT_ENDPOINT', 'oauth2/v2.0/logout'),
        ],

        'scopes' => [
            'default' => env('MICROSOFT_DEFAULT_SCOPE', 'https://graph.microsoft.com/.default'),
            'user_read' => 'https://graph.microsoft.com/User.Read',
            'mail_read' => 'https://graph.microsoft.com/Mail.Read',
            'calendar_read' => 'https://graph.microsoft.com/Calendars.Read',
            'files_read' => 'https://graph.microsoft.com/Files.Read.All',
        ],

        'grant_types' => [
            'client_credentials' => 'client_credentials',
            'authorization_code' => 'authorization_code',
            'refresh_token' => 'refresh_token',
        ],
    ],

    'api' => [
        'domain' => env('MICROSOFT_API_DOMAIN', 'https://graph.microsoft.com'),

        'versions' => [
            'graph' => env('MICROSOFT_GRAPH_VERSION', 'v1.0'),
            'beta' => 'beta',
        ],

        'endpoints' => [
            'users' => 'users',
            'me' => 'me',
            'groups' => 'groups',
            'applications' => 'applications',
            'mail' => 'me/messages',
            'calendar' => 'me/calendar',
            'contacts' => 'me/contacts',
            'drive' => 'me/drive',
        ],
    ],
];
