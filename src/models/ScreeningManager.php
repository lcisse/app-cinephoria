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

    public function createScreening($movieId, $roomId, $screeningDate, $startTime, $endTime, $cinemaId, $seatCapacity)
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

        return $this->pdo->lastInsertId();
        //$screeningId = $this->pdo->lastInsertId();
    
    }

    public function deleteSeatsForCompletedScreenings()
    {
        $sql = "SELECT id FROM screenings 
                WHERE CONCAT(screening_day, ' ', end_time) < NOW()";
        $stmt = $this->pdo->query($sql);
        $completedScreenings = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($completedScreenings)) {
            $sql = "DELETE FROM seats 
                    WHERE screening_id = :screening_id";
            $stmt = $this->pdo->prepare($sql);

            foreach ($completedScreenings as $screeningId) {
                $stmt->execute([':screening_id' => $screeningId]);
            }
        }
    }

    public function getScreeningsByMovie($movieId)
    {
        $sql = "SELECT 
            screenings.id,
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

    public function deleteScreening($screeningId)
    {
        // Récupérer les détails de la séance avant suppression
        $sql = "SELECT movie_id, rooms.cinema_id, screening_day FROM screenings 
                JOIN rooms ON screenings.room_id = rooms.id 
                WHERE screenings.id = :screening_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':screening_id', $screeningId, PDO::PARAM_INT);
        $stmt->execute();
        $screening = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($screening) {
            $movieId = $screening['movie_id'];
            $cinemaId = $screening['cinema_id'];
            $screeningDay = $screening['screening_day'];

            $sql = "DELETE FROM screenings WHERE id = :screening_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':screening_id', $screeningId, PDO::PARAM_INT);
            $stmt->execute();

            // Vérifier s'il reste d'autres séances pour ce film, ce cinéma et ce jour
            $sql = "SELECT COUNT(*) FROM screenings 
                    JOIN rooms ON screenings.room_id = rooms.id 
                    WHERE screenings.movie_id = :movie_id 
                    AND rooms.cinema_id = :cinema_id 
                    AND screenings.screening_day = :screening_day";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
            $stmt->bindParam(':cinema_id', $cinemaId, PDO::PARAM_INT);
            $stmt->bindParam(':screening_day', $screeningDay, PDO::PARAM_STR);
            $stmt->execute();

            $remainingScreenings = $stmt->fetchColumn();

            if ($remainingScreenings == 0) {
                $sql = "DELETE FROM movie_schedule 
                        WHERE movie_id = :movie_id 
                        AND cinema_id = :cinema_id 
                        AND screening_day = :screening_day";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindParam(':movie_id', $movieId, PDO::PARAM_INT);
                $stmt->bindParam(':cinema_id', $cinemaId, PDO::PARAM_INT);
                $stmt->bindParam(':screening_day', $screeningDay, PDO::PARAM_STR);
                $stmt->execute();
            }
        }
    }

    public function updateScreening($screeningId, $movieId, $roomId, $screeningDate, $startTime, $endTime)
    {
        $sql = "UPDATE screenings 
                SET movie_id = :movie_id, room_id = :room_id, screening_day = :screening_day, start_time = :start_time, end_time = :end_time 
                WHERE id = :screening_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':movie_id' => $movieId,
            ':room_id' => $roomId,
            ':screening_day' => $screeningDate,
            ':start_time' => $startTime,
            ':end_time' => $endTime,
            ':screening_id' => $screeningId
        ]);
    }

    /*public function getScreeningDetailsById($screeningId)
    {
        $sql = "SELECT 
                    screenings.id,
                    screenings.screening_day,
                    TIME_FORMAT(screenings.start_time, '%H:%i') AS start_time, 
                    TIME_FORMAT(screenings.end_time, '%H:%i') AS end_time,  
                    rooms.room_number, 
                    rooms.projection_quality,
                    cinemas.cinema_name,
                    cinemas.id AS cinema_id,  
                    rooms.id AS room_id,
                    movie_schedule.cinema_id AS schedule_cinema_id
                FROM screenings
                JOIN rooms ON screenings.room_id = rooms.id 
                JOIN cinemas ON rooms.cinema_id = cinemas.id
                JOIN movie_schedule ON screenings.movie_id = movie_schedule.movie_id 
                                    AND screenings.screening_day = movie_schedule.screening_day
                WHERE screenings.id = :screening_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':screening_id', $screeningId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/

    /*public function resetSeatsAfterScreening()
    {
        $sql = "SELECT DISTINCT rooms.id AS room_id, rooms.cinema_id
                FROM screenings
                JOIN rooms ON screenings.room_id = rooms.id
                WHERE CONCAT(screenings.screening_day, ' ', screenings.end_time) < NOW()";
        
        $stmt = $this->pdo->query($sql);
        $roomsToReset = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($roomsToReset as $room) {
            $sql = "UPDATE seats 
                    SET reserved = 0 
                    WHERE room_id = :room_id AND cinema_id = :cinema_id";
            
            $resetStmt = $this->pdo->prepare($sql);
            $resetStmt->execute([
                ':room_id' => $room['room_id'],
                ':cinema_id' => $room['cinema_id']
            ]);
        }
    }*/

    public function getAllScreenings()
    {
        $sql = "SELECT * FROM screenings";
        return $this->fetchAll($sql);
    }
}