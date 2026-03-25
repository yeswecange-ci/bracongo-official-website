<?php

/**
 * Custom router for PHP built-in server (php artisan serve).
 *
 * Uses __DIR__ (absolute, compile-time constant) instead of getcwd()
 * which can be modified by Laravel or third-party code during the first
 * request and would break static-file serving for subsequent requests.
 */
$publicPath = __DIR__ . DIRECTORY_SEPARATOR . 'public';

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

if ($uri !== '/' && file_exists($publicPath . $uri)) {
    return false;
}

require_once $publicPath . DIRECTORY_SEPARATOR . 'index.php';
