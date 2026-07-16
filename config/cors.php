<?php

return [
    'paths' => ['api/*', 'payment/*'],
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    'allowed_origins' => [env('FRONTEND_URL', 'http://localhost:5173')],
    'allowed_origins_patterns' => ['/https:\/\/.*\.onrender\.com$/', '/https:\/\/.*\.up\.railway\.app$/'],
    'allowed_headers' => ['Content-Type', 'Authorization', 'X-Requested-With', 'Accept', 'X-FedaPay-Signature'],
    'supports_credentials' => true,
];
