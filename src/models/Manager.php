<?php
namespace App\Models; 

use PDO;
use PDOException;

class Manager 
{
    // Instance unique de PDO et de la classe Manager
    private static $instance = null;
    private $bdd;

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct() 
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=lc_cinephoria;charset=utf8', 'root', '');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Méthode statique pour obtenir l'instance unique
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Manager();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->bdd;
    }
}