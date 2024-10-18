<?php
namespace App\Models;

class GenreManager extends BaseManager
{
    // Méthode pour créer la table "genres"
    public function createGenresTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS genres (
            id INT PRIMARY KEY AUTO_INCREMENT,
            genre_name VARCHAR(255) NOT NULL
        )";
        $this->executeQuery($sql, 'Table "genres" créée avec succès.');
    }

    public function getAllGenres()
    {
        $sql = "SELECT * FROM genres";
        return $this->fetchAll($sql);
    }

    
}
