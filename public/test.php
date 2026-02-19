<?php
/**
 * cPanel / Subdomain test - Sorun çözüldükten sonra SİLİN!
 * Erişim: https://demo.sitename.com/test.php
 */
header('Content-Type: text/html; charset=utf-8');
echo "<h1>PHP Çalışıyor</h1>";
echo "<p>PHP Sürümü: " . PHP_VERSION . "</p>";
echo "<p>Gerekli: PHP 8.1+</p>";

$required = ['pdo', 'mbstring', 'openssl', 'tokenizer', 'json', 'ctype', 'fileinfo'];
$missing = [];
foreach ($required as $ext) {
    if (!extension_loaded($ext)) $missing[] = $ext;
}
echo "<p>Eksik PHP eklentileri: " . (empty($missing) ? 'Yok ✓' : implode(', ', $missing)) . "</p>";

$storage = dirname(__DIR__) . '/storage';
$writable = is_writable($storage);
echo "<p>storage yazılabilir: " . ($writable ? 'Evet ✓' : 'HAYIR ✗') . "</p>";

$envPath = dirname(__DIR__) . '/.env';
$envExists = file_exists($envPath);
echo "<p>.env dosyası: " . ($envExists ? 'Var ✓' : 'YOK ✗') . "</p>";

if ($envExists) {
    $env = file_get_contents($envPath);
    $hasKey = strpos($env, 'APP_KEY=base64:') !== false;
    echo "<p>APP_KEY ayarlı: " . ($hasKey ? 'Evet ✓' : 'Hayır ✗') . "</p>";
}
