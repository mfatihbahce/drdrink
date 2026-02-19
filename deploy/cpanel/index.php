<?php
/**
 * cPanel Deployment - public_html için
 * Laravel projesi public_html/dışında bir klasörde olmalı (örn: drdrink)
 * Bu dosyayı public_html/ içine kopyalayın.
 */

$laravelPath = dirname(__DIR__) . '/drdrink/public/index.php';

if (!file_exists($laravelPath)) {
    $laravelPath = dirname(__DIR__, 2) . '/drdrink/public/index.php';
}
if (!file_exists($laravelPath)) {
    $laravelPath = __DIR__ . '/../drdrink/public/index.php';
}
if (!file_exists($laravelPath)) {
    http_response_code(500);
    echo '<h1>Laravel bulunamadı</h1><p>Laravel projesi <code>drdrink</code> klasöründe olmalı (public_html ile aynı seviyede).</p>';
    exit;
}

require $laravelPath;
