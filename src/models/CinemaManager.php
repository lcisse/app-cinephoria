<?php
namespace App\models;

use PDO;

class CinemaManager extends BaseManager
{
    public function createCinemasTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS cinemas (
            id INT PRIMARY KEY AUTO_INCREMENT,
            cinema_name VARCHAR(255) NOT NULL,
            location VARCHAR(255)
        )";
        $this->executeQuery($sql, 'Table "cinemas" créée avec succès.');
    }

    public function getAllCinemas()
    {
        $sql = "SELECT * FROM cinemas";
        return $this->fetchAll($sql);
    }

    public function getCinemaNameById($cinemaId)
    {
        $sql = "SELECT cinema_name FROM cinemas WHERE id = :cinemaId";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':cinemaId', $cinemaId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result['cinema_name'] ?? null; 
    }
}