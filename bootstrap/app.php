<?php

use App\Http\Middleware\is_admin;
use App\Http\Middleware\is_adminOrRektor;
use App\Http\Middleware\is_mahasiswa;
use App\Http\Middleware\is_rektor;
use App\Http\Middleware\is_warek;
use App\Http\Middleware\isAdminOrWarekOrRektor;
use App\Http\Middleware\isAdminWarek;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is_admin' => is_admin::class,
            'is_rektor' => is_rektor::class,
            'is_warek' => is_warek::class,
            'is_mahasiswa' => is_mahasiswa::class,
            'is_adminOrRektor' => is_adminOrRektor::class,
            'is_adminOrWarek' => isAdminWarek::class,
            'is_adminOrWarekOrRektor' => isAdminOrWarekOrRektor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
