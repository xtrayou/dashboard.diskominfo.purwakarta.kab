<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap the application...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Get the HTTP kernel instance...
/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);

// Create the request...
$request = Request::capture();

// Handle the request and send response...
$response = $kernel->handle($request);
$response->send();

// Terminate the request...
$kernel->terminate($request, $response);
