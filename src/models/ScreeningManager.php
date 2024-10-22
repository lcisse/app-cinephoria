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

    public function getScreeningsByMovie($movieId)
    {
        $sql = "SELECT 
            screenings.screening_day,
            TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
            TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
            rooms.room_number, 
            rooms.projection_quality,
            cinemas.cinema_name
        FROM screenings
        JOIN rooms ON screenings.room_id = rooms.id 
        JOIN cinemas ON rooms.cinema_id = cinemas.id
        WHERE screenings.movie_id = :movie_id
        GROUP BY screenings.screening_day, screenings.start_time, rooms.room_number
        ORDER BY screenings.screening_day DESC, screenings.start_time DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllScreenings()
    {
        $sql = "SELECT * FROM screenings";
        return $this->fetchAll($sql);
    }
}