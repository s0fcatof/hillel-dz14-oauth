<?php

return [
    'google' => [
        'client_id' => env('OAUTH_GOOGLE_CLIENT_ID'),
        'client_secret' => env('OAUTH_GOOGLE_CLIENT_SECRET'),
        'callback_uri' => env('OAUTH_GOOGLE_CALLBACK_URI'),
    ]
];
