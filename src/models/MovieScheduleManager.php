<?php
namespace App\Models;

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

    public function getAllMovieSchedules()
    {
        $sql = "SELECT * FROM movie_schedule";
        return $this->fetchAll($sql);
    }
}