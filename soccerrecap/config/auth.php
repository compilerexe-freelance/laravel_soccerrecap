<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'member',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ]
    ],

    'providers' => [
        'member' => [
            'driver' => 'database',
            'table' => 'member',
        ],
        'admin' => [
            'driver' => 'database',
            'table' => 'administrator',
        ]
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
