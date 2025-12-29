<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AuditLogMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            require __DIR__ . '/../routes/profile.php';
            require __DIR__ . '/../routes/auth.php';   // <-- tambahkan baris ini
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // alias middleware route
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'audit_log' => AuditLogMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
