<?php
namespace App\Models;

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
}