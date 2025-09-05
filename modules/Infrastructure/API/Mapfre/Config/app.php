<?php

return [
    'timeout' => env('MAPFRE_TIMEOUT', 60),
    'retry_attempts' => env('MAPFRE_RETRY_ATTEMPTS', 3),
    'retry_delay' => env('MAPFRE_RETRY_DELAY', 2000),
    'rate_limit_per_minute' => env('MAPFRE_RATE_LIMIT', 100),

    'api' => [
        'domain' => env('MAPFRE_API_DOMAIN', 'https://apipre.mapfrebhd.com.do'),
        'base_path' => env('MAPFRE_BASE_PATH', '/dom/api'),

        'versions' => [
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
        ],
    ],
];
