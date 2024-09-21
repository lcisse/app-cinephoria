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
        /*$sql = "SELECT * FROM movies";
        return $this->fetchAll($sql);*/

        $sql = "SELECT 
                    movies.id, 
                    movies.title, 
                    movies.description, 
                    movies.age_minimum, 
                    movies.favorite,
                    movies.poster,
                    GROUP_CONCAT(DISTINCT genres.genre_name SEPARATOR ', ') AS genre,  -- Agrégation des genres
                    cinemas.cinema_name AS cinema,  -- Nom du cinéma
                    GROUP_CONCAT(DISTINCT DATE_FORMAT(movie_schedule.screening_day, '%W') SEPARATOR ', ') AS screening_days  -- Agrégation des jours de projection
                FROM movies
                LEFT JOIN movie_genres ON movies.id = movie_genres.movie_id
                LEFT JOIN genres ON movie_genres.genre_id = genres.id
                LEFT JOIN movie_schedule ON movies.id = movie_schedule.movie_id
                LEFT JOIN cinemas ON movie_schedule.cinema_id = cinemas.id
                GROUP BY movies.id";  // Groupement par film

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

    public function getMovieScreenings($movieId)
    {
        $sql = "SELECT 
                    movies.title,
                    movies.description, 
                    movies.poster,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
                    rooms.room_number, 
                    rooms.projection_quality,
                    screenings.screening_day
                FROM screenings
                JOIN movies ON screenings.movie_id = movies.id
                JOIN rooms ON screenings.room_id = rooms.id 
                WHERE movies.id = :movie_id";
                //AND movie_schedule.screening_day = :screening_day;

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        //$stmt->bindParam(':screening_day', $date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getScreeningsByDate($movieId, $date)
    {
        $sql = "SELECT 
                    movies.title,
                    movies.description, 
                    movies.poster,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
                    rooms.room_number, 
                    rooms.projection_quality,
                    screenings.screening_day
                FROM screenings
                JOIN movies ON screenings.movie_id = movies.id
                JOIN rooms ON screenings.room_id = rooms.id
                WHERE movies.id = :movie_id
                AND screenings.screening_day = :screening_day";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->bindParam(':screening_day', $date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}