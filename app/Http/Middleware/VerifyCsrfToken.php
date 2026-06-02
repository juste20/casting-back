<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * URI qui ne doivent *pas* être protégés par le CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];

    /**
     * Si vrai, Laravel met aussi le token dans un cookie pour usage JS.
     *
     * @var bool
     */
    protected $addHttpCookie = true;
}
