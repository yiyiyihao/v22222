<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        //路由1，路由2，路由3
        // 'home/test5',
        // 'home/test6',
        // 所有的路由都不要验证
        // '*'
        '/Subscribe/Verify',
        '/Subscribe/Snap',
    ];
}
