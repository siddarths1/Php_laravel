<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;

echo "app.php entry - bootstrap.php  -------------->";


Log::info('Base Path: ' . dirname(__DIR__));
Log::info('Web Route Path: ' . __DIR__ . '/../routes/web.php');

//When a web request is made, the routes/web.php file is loaded.
//When a console command is run, the routes/console.php file is executed.


return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        echo "Middleware loaded!"; // Test output here
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();


//Middleware are filters that process HTTP requests before they reach the controller.
//Example: Authenticating users, logging, and verifying CSRF tokens.

