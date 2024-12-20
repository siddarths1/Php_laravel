<?php

use Illuminate\Http\Request;

echo "index.php entry --------------------><br>";
define('LARAVEL_START', microtime(true));
//It is used to measure how long it takes for the application to handle the request (helpful for performance profiling).

// Determine if the application is in maintenance mode...
//Laravel has a maintenance mode feature
// immediately halt further execution and display a maintenance response.

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

echo "vendor/autoload.php entry - index.php  --------------------> <br>";


// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';
//Laravel relies on Composer for managing dependencies.
//load all required classes and libraries automatically.

echo "bootstrap/app.ph entry - index.php  --------------------><br>";


// Bootstrap Laravel and handle the request...
// bootstrap/app.php file initializes the core Laravel components and returns an instance of the application.
(require_once __DIR__ . '/../bootstrap/app.php')
    ->handleRequest(Request::capture());
// Simulate a request capture
// Access data from the captured request
$request = Request::capture();
$path = $request->path();
echo "Path: $path\n";

echo "bootstrap/app.ph exit - index.php  -------------------->";
echo "index.php exit -------------------->";

