<?php

return [
    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS_FILE'),
        'auto_discovery' => env('FIREBASE_CREDENTIALS_AUTO_DISCOVERY', true),
    ],
    // 'database_url' => env('FIREBASE_URL', ''),
    // Add more configuration options as needed
];
