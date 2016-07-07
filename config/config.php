<?php
return [
    'root_domain' => 'mvc/',
    'site_name' => 'Your Site Name',
    'languages' => ['en', 'fr'],
    'components' => [
        'router' => [
            'class' => 'Router',
            'routes' => [
                'default' => '',
                'admin' => 'admin_',
            ]
        ],
        'db' => [
            'class' => 'DB',
            'conn_string' => 'mysql:host=localhost;dbname=test_mvc',
            'db_user' => 'root',
            'db_passw' => '',
        ],
    ],
];
