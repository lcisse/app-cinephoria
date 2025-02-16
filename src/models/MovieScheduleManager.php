<?php
namespace App\models;

class MovieScheduleManager extends BaseManager
{
    public function createMovieScheduleTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS movie_schedule (
            movie_id INT,
            cinema_id INT,
            screening_day DATE,
            PRIMARY KEY (movie_id, cinema_id, screening_day),
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (cinema_id) REFERENCES cinemas(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "movie_schedule" créée avec succès.');
    }

    public function addMovieSchedule($movieId, $cinemaId, $screeningDate)
    {
        $sql = "INSERT INTO movie_schedule (movie_id, cinema_id, screening_day)
                VALUES (:movie_id, :cinema_id, :screening_day)
                ON DUPLICATE KEY UPDATE screening_day = :screening_day";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':movie_id' => $movieId,
            ':cinema_id' => $cinemaId,
            ':screening_day' => $screeningDate
        ]);
    }

    public function updateMovieSchedule($movieId, $cinemaId, $screeningDate)
    {
        // Vérifier si une entrée pour ce film, cinéma et date existe déjà
        $sql = "SELECT COUNT(*) FROM movie_schedule 
                WHERE movie_id = :movie_id AND cinema_id = :cinema_id AND screening_day = :screening_day";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':movie_id' => $movieId,
            ':cinema_id' => $cinemaId,
            ':screening_day' => $screeningDate
        ]);

        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            $sql = "UPDATE movie_schedule 
                    SET screening_day = :screening_day
                    WHERE movie_id = :movie_id AND cinema_id = :cinema_id AND screening_day = :screening_day";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':screening_day' => $screeningDate,
                ':movie_id' => $movieId,
                ':cinema_id' => $cinemaId
            ]);
        } else {
            // Si l'entrée n'existe pas, l'insérer
            $sql = "INSERT INTO movie_schedule (movie_id, cinema_id, screening_day) 
                    VALUES (:movie_id, :cinema_id, :screening_day)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':movie_id' => $movieId,
                ':cinema_id' => $cinemaId,
                ':screening_day' => $screeningDate
            ]);
        }
    }

    public function getAllMovieSchedules()
    {
        $sql = "SELECT * FROM movie_schedule";
        return $this->fetchAll($sql);
    }
}