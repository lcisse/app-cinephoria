<?php
namespace App\Models;

class RoomManager extends BaseManager
{
    // Méthode pour créer la table "rooms" (salles de cinéma)
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

    // Méthode pour récupérer toutes les salles
    public function getAllRooms()
    {
        $sql = "SELECT * FROM rooms";
        return $this->fetchAll($sql);
    }
}