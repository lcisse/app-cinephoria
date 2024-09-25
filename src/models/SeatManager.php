<?php
namespace App\Models;

class SeatManager extends BaseManager
{
    public function createSeatsTable()
    {
        $sql = "DROP TABLE IF EXISTS seats";
        $this->executeQuery($sql, 'Table "seats" supprimée avec succès.');

        $sql = "CREATE TABLE IF NOT EXISTS seats (
            id INT PRIMARY KEY AUTO_INCREMENT,
            room_id INT, -- Salle à laquelle le siège appartient
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
}