<?php
namespace App\Models;

use PDO;
use PDOException;
use App\Models\Manager;

class BaseManager
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Manager::getInstance()->getConnection();
    }

    protected function executeQuery($sql, $successMessage)
    {
        try {
            $this->pdo->exec($sql);
            echo $successMessage . "\n";
        } catch (PDOException $e) {
            echo "Erreur lors de l'exécution de la requête : " . $e->getMessage() . "\n";
        }
    }

    protected function fetchAll($sql)
    {
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function fetchOne($sql)
    {
        $stmt = $this->pdo->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setPdo(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
}