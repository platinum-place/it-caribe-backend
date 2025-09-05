<?php

return [
    'api' => [
        'domain' => env('MAPFRE_API_DOMAIN', 'https://apipre.mapfrebhd.com.do'),
        'base_path' => env('MAPFRE_BASE_PATH', '/dom/api'),

        'versions' => [
            'v1' => env('MAPFRE_API_VERSION', 'v1'),
            'current' => env('MAPFRE_CURRENT_VERSION', 'v1'),
        ],

        'endpoints' => [
            'project' => [
                'base' => 'project',
                'monthly_auto_trebol' => 'project/monthlyAutoTrebol',
                'weekly_reports' => 'project/weeklyReports',
                'annual_summary' => 'project/annualSummary',
            ],

            'catalog' => [
                'base' => 'catalog',
                'vehicle_uses' => 'catalog/vehicleUses',
                'vehicle_brands' => 'catalog/vehicleBrands',
                'vehicle_models' => 'catalog/vehicleModels',
                'coverage_types' => 'catalog/coverageTypes',
                'provinces' => 'catalog/provinces',
                'municipalities' => 'catalog/municipalities',
            ],

            'quotes' => [
                'base' => 'quotes',
                'auto_quote' => 'quotes/auto',
                'home_quote' => 'quotes/home',
                'life_quote' => 'quotes/life',
                'validate_quote' => 'quotes/validate',
            ],

            'policies' => [
                'base' => 'policies',
                'search' => 'policies/search',
                'details' => 'policies/details',
                'renew' => 'policies/renew',
                'cancel' => 'policies/cancel',
                'documents' => 'policies/documents',
            ],

            'clients' => [
                'base' => 'clients',
                'search' => 'clients/search',
                'create' => 'clients/create',
                'update' => 'clients/update',
                'documents' => 'clients/documents',
            ],

            'claims' => [
                'base' => 'claims',
                'create' => 'claims/create',
                'status' => 'claims/status',
                'documents' => 'claims/documents',
                'history' => 'claims/history',
            ],

            'auth' => [
                'base' => 'auth',
                'login' => 'segurnet/login',
                'refresh' => 'auth/refresh',
                'logout' => 'auth/logout',
            ],
        ],
    ],

    'authentication' => [
        'method' => env('MAPFRE_AUTH_METHOD', 'bearer'), // bearer, api_key, basic
        'credentials' => [
            'api_key' => env('MAPFRE_API_KEY'),
            'username' => env('MAPFRE_USERNAME'),
            'password' => env('MAPFRE_PASSWORD'),
        ],
        'headers' => [
            'content_type' => env('MAPFRE_CONTENT_TYPE', 'application/json'),
            'accept' => env('MAPFRE_ACCEPT', 'application/json'),
            'api_version' => env('MAPFRE_API_VERSION_HEADER', 'v1'),
        ],
    ],

    // Configuraciones generales
    'defaults' => [
        'timeout' => env('MAPFRE_TIMEOUT', 60), // Más tiempo para APIs de seguros
        'retry_attempts' => env('MAPFRE_RETRY_ATTEMPTS', 3),
        'retry_delay' => env('MAPFRE_RETRY_DELAY', 2000), // 2 segundos
        'rate_limit_per_minute' => env('MAPFRE_RATE_LIMIT', 100),
        'user_agent' => env('APP_NAME', 'Laravel') . '/' . env('APP_VERSION', '1.0') . ' (Mapfre Integration)',
    ],

    'environments' => [
        'production' => [
            'domain' => 'https://api.mapfrebhd.com.do',
            'base_path' => '/dom/api',
        ],
        'staging' => [
            'domain' => 'https://apipre.mapfrebhd.com.do',
            'base_path' => '/dom/api',
        ],
        'development' => [
            'domain' => 'https://apidev.mapfrebhd.com.do',
            'base_path' => '/dom/api',
        ],
    ],
];
