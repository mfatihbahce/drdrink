<?php
/**
 * 500 Hata Ayıklama - Laravel handleRequest hatasını yakalar
 * Erişim: https://drdrink.com.tr/public/bootstrap-debug.php
 * Sorun çözülünce SİLİN!
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('log_errors', '0');

header('Content-Type: text/html; charset=utf-8');
ob_implicit_flush(true);
if (ob_get_level()) ob_end_flush();

echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Bootstrap Debug</title></head><body><pre>";
echo "0. Script started... OK\n";
flush();

register_shutdown_function(function () {
    $e = error_get_last();
    if ($e && in_array($e['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        echo "\n\n=== FATAL HATA ===\n";
        echo "Mesaj: " . $e['message'] . "\n";
        echo "Dosya: " . $e['file'] . " (Satır " . $e['line'] . ")\n";
    }
});

try {
    echo "1. vendor/autoload.php... ";
    flush();
    require __DIR__.'/../vendor/autoload.php';
    echo "OK\n";
    flush();

    echo "2. bootstrap/app.php... ";
    flush();
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "OK\n";
    flush();

    echo "3. Request::capture()... ";
    flush();
    $request = \Illuminate\Http\Request::capture();
    echo "OK\n";
    flush();

    echo "4. Ana sayfa istegi (/) simule ediliyor... ";
    $request = \Illuminate\Http\Request::create('/');
    echo "OK\n";
    flush();

    echo "5. handleRequest()... ";
    flush();
    $app->handleRequest($request);
    echo "OK\n";

} catch (Throwable $e) {
    $err = "\n\n=== HATA ===\n" . $e->getMessage() . "\n" . $e->getFile() . ":" . $e->getLine() . "\n" . $e->getTraceAsString();
    @file_put_contents(__DIR__.'/../storage/logs/bootstrap-debug-error.txt', date('Y-m-d H:i:s').$err);
    echo "\n\n=== HATA ===\n";
    echo "Mesaj: " . htmlspecialchars($e->getMessage()) . "\n";
    echo "Dosya: " . $e->getFile() . " (Satir " . $e->getLine() . ")\n\n";
    echo "Stack trace:\n" . htmlspecialchars($e->getTraceAsString());
}

echo "</pre></body></html>";
