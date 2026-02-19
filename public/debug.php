<?php
/**
 * 500 Hata Ayıklama - Sorun çözüldükten sonra SİLİN!
 * Erişim: https://siteniz.com/debug.php
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=utf-8');

echo "<h1>Laravel Bootstrap Test</h1>";

try {
    echo "<p>1. vendor/autoload.php... ";
    require __DIR__.'/../vendor/autoload.php';
    echo "OK</p>";

    echo "<p>2. bootstrap/app.php... ";
    $app = require_once __DIR__.'/../bootstrap/app.php';
    echo "OK</p>";

    echo "<p>3. .env... ";
    $envPath = __DIR__.'/../.env';
    if (!file_exists($envPath)) {
        throw new Exception('.env dosyası bulunamadı! .env.example\'dan kopyalayın.');
    }
    echo "OK</p>";

    echo "<p>4. APP_KEY... ";
    $env = file_get_contents($envPath);
    if (strpos($env, 'APP_KEY=base64:') === false && strpos($env, 'APP_KEY=') !== false) {
        throw new Exception('APP_KEY boş! Sunucuda: php artisan key:generate');
    }
    echo "OK</p>";

    echo "<p>5. storage yazılabilir... ";
    if (!is_writable(__DIR__.'/../storage')) {
        throw new Exception('storage klasörü yazılabilir değil! chmod 775 storage');
    }
    echo "OK</p>";

    echo "<h2 style='color:green'>Tüm kontroller geçti. Laravel yüklenebilir.</h2>";
    echo "<p>500 hatası devam ediyorsa storage/logs/laravel.log dosyasına bakın.</p>";

} catch (Throwable $e) {
    echo "<h2 style='color:red'>HATA: " . htmlspecialchars($e->getMessage()) . "</h2>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
