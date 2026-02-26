<?php

use App\Exceptions\BaseException;
use App\Exceptions\BusinessException;
use App\HTTP\Middlewares\EncryptCookies;
use App\HTTP\Middlewares\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->group('web', [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Don't report BusinessException as server errors
        $exceptions->dontReport(
            [
                BusinessException::class,
            ]
        );

        // Use custom render strategy for BaseException and its children
        // Must return response directly to prevent Laravel from hiding the message
        $exceptions->renderable(function (BaseException $e, $request) {
            return $e->render($request);
        });
    })->create();
