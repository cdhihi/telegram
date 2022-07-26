<?php
return [
    'name'  => 'auth-center',
    'debug' => env('SWOFT_DEBUG', 1),

    'auth' => [
        'jwt' => [
            'algorithm' => 'HS256',
            'secret' => '1231231'
        ],
    ],
    'telegram_callback_api' => "https://4676-136-158-30-3.ap.ngrok.io"
];
