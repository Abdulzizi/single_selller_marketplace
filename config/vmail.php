<?php

return [
    'default_from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'no-reply@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example App')
    ],
    'queue' => [
        'enabled' => env('VMAIL_QUEUE_ENABLED', false),
        'connection' => env('QUEUE_CONNECTION', 'database')
    ]
];