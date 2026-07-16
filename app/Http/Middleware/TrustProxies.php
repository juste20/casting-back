<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    protected $proxies = [
        '13.64.0.0/11',
        '13.104.0.0/14',
        '20.33.0.0/16',
        '20.40.0.0/13',
        '20.128.0.0/16',
        '40.64.0.0/10',
        '52.96.0.0/12',
        '65.52.0.0/14',
        '104.40.0.0/13',
        '147.243.0.0/16',
    ];

    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
