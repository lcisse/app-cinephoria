<?php
namespace App\models;

use PDO;

class SeatManager extends BaseManager
{
    public function createSeatsTable()
    {
        $sql = "DROP TABLE IF EXISTS seats";
        $this->executeQuery($sql, 'Table "seats" supprimée avec succès.');

        $sql = "CREATE TABLE IF NOT EXISTS seats (
            id INT PRIMARY KEY AUTO_INCREMENT,
            room_id INT, -- Salle à laquelle le siège appartient
            cinema_id INT, 
            screening_id INT, 
            seat_number VARCHAR(10), 
            reserved TINYINT DEFAULT 0, -- Indique si le siège est réservé (0: libre, 1: réservé)
            is_accessible TINYINT DEFAULT 0, -- Si le siège est réservé aux personnes à mobilité réduite
            FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "seats" créée avec succès.');
    }

    public function getAllSeats()
    {
        $sql = "SELECT * FROM seats";
        return $this->fetchAll($sql);
    }

    public function createSeatsForScreening($screeningId, $roomId, $cinemaId, $seatCapacity)
    {
        // Vérifier si des sièges existent déjà pour cette séance
        $sql = "SELECT COUNT(*) AS seat_count FROM seats WHERE screening_id = :screening_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':screening_id' => $screeningId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['seat_count'] > 0) {
            return; // Les sièges sont déjà créés pour cette séance
        }

        $sql = "INSERT INTO seats (room_id, cinema_id, screening_id, seat_number, is_accessible) 
            VALUES (:room_id, :cinema_id, :screening_id, :seat_number, :is_accessible)";
        $stmt = $this->pdo->prepare($sql);

        for ($i = 1; $i <= $seatCapacity; $i++) {
            $seatNumber = sprintf("%02d", $i); // Numéro de siège formaté

            $isAccessible = in_array($seatNumber, ['01', '02', '09', '10']) ? 1 : 0;

            $stmt->execute([
                ':room_id' => $roomId,
                ':cinema_id' => $cinemaId,
                ':screening_id' => $screeningId,
                ':seat_number' => $seatNumber,
                ':is_accessible' => $isAccessible
            ]);
        }
    }

    public function getAvailableSeats($screeningId)
    {
        $sql = "SELECT COUNT(*) AS total_available_seats
                FROM seats
                WHERE screening_id = :screening_id AND reserved = 0";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':screening_id' => $screeningId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total_available_seats'] ?? 0; 
    }
}