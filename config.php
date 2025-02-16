<?php
/*if (!defined('BASE_URL')) {
    $root = str_replace('\\', '/', dirname(__DIR__));  
    
    $base_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $root) . '/app-cinephoria';

    //define('BASE_URL', $base_url); //sans docker
    define('BASE_URL', 'http://localhost:8080'); // avec docker
}*/
if (!defined('BASE_URL')) {
    // Récupérer l'URL de base dynamiquement
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST']; // Cela récupère l'IP ou le nom de domaine du serveur

    // Construire l'URL de base sans '/app-cinephoria'
    $base_url = $protocol . '://' . $host;

    define('BASE_URL', $base_url);
}