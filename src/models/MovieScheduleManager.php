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

    public function getAllMovieSchedules()
    {
        $sql = "SELECT * FROM movie_schedule";
        return $this->fetchAll($sql);
    }
}