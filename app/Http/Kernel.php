<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Other middleware...

    protected $routeMiddleware = [
        // Other middleware...
        'disabled.check' => \App\Http\Middleware\DisabledCheckMiddleware::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];

    // Other methods...
}
