<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$debug500 = file_exists(__DIR__.'/../storage/framework/DEBUG_500');
if ($debug500) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    register_shutdown_function(function () {
        $e = error_get_last();
        if ($e && in_array($e['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            echo '<h1>Fatal Hata</h1><pre>'.htmlspecialchars($e['message']."\n".$e['file'].':'.$e['line']).'</pre>';
        }
    });
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
try {
    /** @var Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';
    $app->handleRequest(Request::capture());
} catch (Throwable $e) {
    if ($debug500 ?? file_exists(__DIR__.'/../storage/framework/DEBUG_500')) {
        http_response_code(500);
        header('Content-Type: text/html; charset=utf-8');
        echo '<h1>500 Hata</h1>';
        echo '<pre>' . htmlspecialchars($e->getMessage() . "\n\n" . $e->getTraceAsString()) . '</pre>';
        exit;
    }
    throw $e;
}
