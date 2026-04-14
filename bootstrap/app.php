<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
<<<<<<< HEAD
=======
          $middleware->alias([
        'auth.login' => \App\Http\Middleware\AuthLogin::class,
    ]);
>>>>>>> b66c4fcd402bf8fe48b69164ba75aa7c991b9709
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
