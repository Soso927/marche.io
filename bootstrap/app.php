<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias middleware pour protéger les routes réservées aux administrateurs.
     // On dit à Laravel : quand tu vois 'role' dans une route,
    // utilise la classe RoleMiddleware de Spatie
    $middleware->alias([
        'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,

        // On en profite pour enregistrer aussi 'permission' et 'role_or_permission'
        // qui sont les deux autres middlewares fournis par Spatie
        // Tu en auras besoin plus tard pour des protections plus fines
        'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
