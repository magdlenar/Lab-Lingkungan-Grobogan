<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// Jika file ada di folder public, serve langsung
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// Selain itu lempar ke Laravel
require_once __DIR__.'/public/index.php';
