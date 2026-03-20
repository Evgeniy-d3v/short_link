<?php

use App\Domain\Entities\Exception\LongLinkNotFoundException;
use App\Infrastructure\Middleware\AuthenticateUser;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'auth.user' => AuthenticateUser::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (LongLinkNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        });
    })->create();
