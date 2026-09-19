<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $sysRoot = getenv('SystemRoot') ?: (getenv('WINDIR') ?: 'C:\Windows');
    putenv("SystemRoot={$sysRoot}");
    putenv("WINDIR={$sysRoot}");
    putenv("SYSTEMDRIVE=" . substr($sysRoot, 0, 2));
    $_ENV['SystemRoot'] = $sysRoot;
    $_SERVER['SystemRoot'] = $sysRoot;
    $_ENV['WINDIR'] = $sysRoot;
    $_SERVER['WINDIR'] = $sysRoot;
}

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
