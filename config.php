<?php
/*if (!defined('BASE_URL')) {
    define('BASE_URL', '/studi/code/app-cinephoria');
}

$root = str_replace('\\', '/', dirname(__DIR__));  

define('BASE_URL', str_replace($_SERVER['DOCUMENT_ROOT'], '', $root));*/

if (!defined('BASE_URL')) {
    $root = str_replace('\\', '/', dirname(__DIR__));  
    
    $base_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $root) . '/app-cinephoria';

    define('BASE_URL', $base_url);
}