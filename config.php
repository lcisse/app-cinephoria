<?php
if (!defined('BASE_URL')) {
    $root = str_replace('\\', '/', dirname(__DIR__));  
    
    $base_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $root) . '/app-cinephoria';

    define('BASE_URL', $base_url);
}