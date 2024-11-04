<?php
namespace App\models\mongodb;
//require 'vendor/autoload.php'; 

use MongoDB\Client;
use MongoDB\Database;

class MongoDBConnection {
    private static $instance = null; 
    protected $client;
    protected $db;

    // Constructor privé pour empêcher l'instanciation directe
    private function __construct($dbName = "cinephoriadb") {
        try {
            $this->client = new Client("mongodb://localhost:27017");
            $this->db = $this->client->$dbName;
        } catch (\Exception $e) {
            echo "Échec de la connexion à MongoDB : " . $e->getMessage();
        }
    }

    // Méthode statique pour obtenir l'instance unique
    public static function getInstance($dbName = "cinephoriadb") {
        if (self::$instance === null) {
            self::$instance = new MongoDBConnection($dbName);
        }
        return self::$instance;
    }

    // Récupérer une collection spécifique
    public function getCollection($collectionName) {
        if ($this->db) {
            return $this->db->$collectionName;
        } else {
            throw new \Exception("Connexion à la base MongoDB non établie.");
        }
    }
}