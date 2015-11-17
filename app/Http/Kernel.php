<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        // \App\Http\Middleware\EncryptCookies::class,
        // \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        // \Illuminate\Session\Middleware\StartSession::class,
        // \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        // \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                       => \App\Http\Middleware\Authenticate::class,
        'auth.basic'                 => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest'                      => \App\Http\Middleware\RedirectIfAuthenticated::class,

        'perchecker'                 => \Sixbyte\Perchecker\PercheckerMiddleware::class,
        'ShareMessageFromSession'    => \App\Http\Middleware\ShareMessageFromSession::class,

        'CheckForMaintenanceMode'    => \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        'EncryptCookies'             => \App\Http\Middleware\EncryptCookies::class,
        'AddQueuedCookiesToResponse' => \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        'StartSession'               => \Illuminate\Session\Middleware\StartSession::class,
        'ShareErrorsFromSession'     => \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        'csrf'                       => \App\Http\Middleware\VerifyCsrfToken::class,
    ];
}
