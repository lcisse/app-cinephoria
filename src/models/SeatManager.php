<?php
namespace App\Models;

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

    public function createSeatsForRoom($roomId, $cinemaId, $seatCapacity)
    {
        // Vérifier si des sièges existent déjà pour cette salle
        $sql = "SELECT COUNT(*) AS seat_count FROM seats WHERE room_id = :room_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':room_id' => $roomId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['seat_count'] > 0) {
            return;
        }

        $sql = "INSERT INTO seats (room_id, cinema_id, seat_number) VALUES (:room_id, :cinema_id, :seat_number)";
        $stmt = $this->pdo->prepare($sql);

        for ($i = 1; $i <= $seatCapacity; $i++) {
            //$seatNumber = str_pad($i, 2, '0', STR_PAD_LEFT); // Formater le numéro (ex: 01, 02, ...)
            $seatNumber = sprintf("%02d", $i);
            $stmt->execute([':room_id' => $roomId, ':cinema_id' => $cinemaId, ':seat_number' => $seatNumber]);
        }
    }

    public function getAvailableSeats($cinemaId, $roomId)
    {
        $sql = "SELECT COUNT(*) AS total_available_seats
                FROM seats
                WHERE cinema_id = :cinema_id AND room_id = :room_id AND reserved = 0";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':cinema_id' => $cinemaId,
            ':room_id' => $roomId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total_available_seats'] ?? 0; 
    }
}