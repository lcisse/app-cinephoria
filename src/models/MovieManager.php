<?php
namespace App\Models;

//use App\Models\BaseManager;
use PDO;
use App\Models\BaseManager;

class MovieManager extends BaseManager
{
    // Méthode pour créer la table "movies"
    public function createMoviesTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movies (
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            age_minimum INT,
            favorite BOOLEAN DEFAULT 0,
            poster VARCHAR(255),
            rating FLOAT
        )";
        $this->executeQuery($sql, 'Table "movies" créée avec succès.');
    }

    // Méthode pour récupérer tous les films
    public function getAllMovies()
    {
        $sql = "SELECT * FROM movies";
        return $this->fetchAll($sql);
    }

    public function getMovieAverageRating($movieId)
    {
        $sql = "SELECT AVG(rating) AS average_rating FROM reviews WHERE movie_id = :movie_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['average_rating'] ?? null;  // Retourner la note moyenne ou null s'il n'y a pas d'avis
    }

}