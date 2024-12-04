<?php
namespace App\Models;

use PDO;

class RoomManager extends BaseManager
{
    public function createRoomsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS rooms (
            id INT PRIMARY KEY AUTO_INCREMENT,
            cinema_id INT,
            room_number VARCHAR(10),
            seat_capacity INT,
            projection_quality VARCHAR(50),
            incident_notes TEXT,
            FOREIGN KEY (cinema_id) REFERENCES cinemas(id) ON DELETE CASCADE
        )";
        $this->executeQuery($sql, 'Table "rooms" créée avec succès.');
    }

    public function createRoom($cinemaId, $roomNumber, $seatCapacity, $projectionQuality)
    {
        $sql = "INSERT INTO rooms (cinema_id, room_number, seat_capacity, projection_quality, incident_notes)
                VALUES (:cinema_id, :room_number, :seat_capacity, :projection_quality, '')"; 
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':cinema_id' => $cinemaId,
            ':room_number' => $roomNumber,
            ':seat_capacity' => $seatCapacity,
            ':projection_quality' => $projectionQuality
        ]);

        return $this->pdo->lastInsertId(); // Retourner l'ID de la salle créée
    }

    public function getAllRoomsWithCinemas()
    {
        $sql = "SELECT 
                    rooms.id,
                    rooms.room_number,
                    rooms.seat_capacity,
                    rooms.projection_quality,
                    rooms.incident_notes,
                    cinemas.cinema_name
                FROM rooms
                JOIN cinemas ON rooms.cinema_id = cinemas.id
                ORDER BY rooms.id DESC";
        
        return $this->fetchAll($sql);
    }

    public function deleteRoom($roomId)
    {
        $sql = "DELETE FROM rooms WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $roomId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getRoomById($roomId)
    {
        $sql = "SELECT * FROM rooms WHERE id = :room_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':room_id', $roomId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRoom($roomId, $cinemaId, $roomNumber, $seatCapacity, $projectionQuality, $incidentNotes)
    {
        $sql = "UPDATE rooms SET 
                    cinema_id = :cinema_id, 
                    room_number = :room_number, 
                    seat_capacity = :seat_capacity, 
                    projection_quality = :projection_quality, 
                    incident_notes = :incident_notes
                WHERE id = :room_id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':cinema_id' => $cinemaId,
            ':room_number' => $roomNumber,
            ':seat_capacity' => $seatCapacity,
            ':projection_quality' => $projectionQuality,
            ':incident_notes' => $incidentNotes,
            ':room_id' => $roomId
        ]);
    }

    public function getAllCinemasWithRooms()
    {
        $sql = "SELECT 
                    cinemas.id AS cinema_id, 
                    cinemas.cinema_name, 
                    rooms.id AS room_id, 
                    rooms.room_number, 
                    rooms.seat_capacity 
                FROM cinemas
                LEFT JOIN rooms ON rooms.cinema_id = cinemas.id";
        
        $results = $this->fetchAll($sql);

        $cinemas = [];
        foreach ($results as $row) {
            $cinemas[$row['cinema_id']]['cinema_name'] = $row['cinema_name'];
            $cinemas[$row['cinema_id']]['rooms'][] = [
                'id' => $row['room_id'],
                'room_number' => $row['room_number'],
                'seat_capacity' => $row['seat_capacity']
            ];
        }

        return $cinemas;  // Retourner les cinémas avec les salles associées
    }

}