<?php
namespace App\Models;

use PDO;
use App\Models\BaseManager;

class ScreeningManager extends BaseManager
{
    public function createScreeningsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS screenings (
            id INT PRIMARY KEY AUTO_INCREMENT,
            movie_id INT,
            room_id INT,
            screening_day DATE,
            start_time TIME,
            end_time TIME,
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "screenings" créée avec succès.');
    }

    public function createScreening($movieId, $roomId, $screeningDate, $startTime, $endTime)
    {
        $sql = "INSERT INTO screenings (movie_id, room_id, screening_day, start_time, end_time)
                VALUES (:movie_id, :room_id, :screening_day, :start_time, :end_time)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':movie_id' => $movieId,
            ':room_id' => $roomId,
            ':screening_day' => $screeningDate,
            ':start_time' => $startTime,
            ':end_time' => $endTime
        ]);
    }

    public function getAllScreenings()
    {
        $sql = "SELECT * FROM screenings";
        return $this->fetchAll($sql);
    }
}