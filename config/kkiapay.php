<?php

return [

    'public_key' => env('KKIAPAY_PUBLIC_KEY'),

    'private_key' => env('KKIAPAY_PRIVATE_KEY'),

    'secret' => env('KKIAPAY_SECRET'),

    'sandbox' => env('KKIAPAY_SANDBOX', true),

    'currency' => 'XOF',

    'callback_url' => env('KKIAPAY_CALLBACK_URL'),

];
