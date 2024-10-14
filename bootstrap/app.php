<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware; // Import your RoleMiddleware

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the RoleMiddleware alias
        $middleware->alias([
            'role' => RoleMiddleware::class, // Assigning alias 'role' to the RoleMiddleware class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
