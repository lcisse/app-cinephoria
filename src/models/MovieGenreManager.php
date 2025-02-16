<?php
namespace App\models;

use PDO;

class MovieGenreManager extends BaseManager
{
    public function createMovieGenresTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movie_genres (
            movie_id INT,
            genre_id INT,
            PRIMARY KEY (movie_id, genre_id),
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "movie_genres" créée avec succès.');
    }

    public function addGenresToMovie($movieId, $genres)
    {
        $sql = "INSERT INTO movie_genres (movie_id, genre_id) VALUES (:movie_id, :genre_id)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($genres as $genreId) {
            $stmt->execute([
                ':movie_id' => $movieId,
                ':genre_id' => $genreId
            ]);
        }
    }

    public function deleteGenresByMovieId($filmId)
    {
        $sql = "DELETE FROM movie_genres WHERE movie_id = :movie_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $filmId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getAllMovieGenres()
    {
        $sql = "SELECT * FROM movie_genres";
        return $this->fetchAll($sql);
    }

    public function updateGenresForMovie($movieId, array $genres)
    {
        $sql = "DELETE FROM movie_genres WHERE movie_id = :movie_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':movie_id' => $movieId]);

        $sql = "INSERT INTO movie_genres (movie_id, genre_id) VALUES (:movie_id, :genre_id)";
        $stmt = $this->pdo->prepare($sql);

        foreach ($genres as $genreId) {
            $stmt->execute([':movie_id' => $movieId, ':genre_id' => $genreId]);
        }
    }

    public function getGenresByMovieId($filmId)
    {
        $sql = "SELECT genre_id FROM movie_genres WHERE movie_id = :movie_id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $filmId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_COLUMN); 
    }
}