<?php

return [
    'hosts'=>[
        'api' =>'https://apipre.mapfrebhd.com.do/dom/api',
        'microsoft_oauth' =>'https://login.microsoftonline.com',
    ],

    'credentials'=>[
        'api' => [
            'username' => '',
            'password' => ''
        ],

        'microsoft_oauth' => [
            'client_id' => '',
            'client_secret' => '',
            'tenant_id'=>'',
        ],
    ],

    'endpoints'=>[
        'api' => [
            'login'=>'segurnet/login',
        ],

        'microsoft_oauth' => [
            'login'=>'oauth2/v2.0/token',
        ],
    ],
];
