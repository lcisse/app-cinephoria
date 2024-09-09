<?php
namespace App\Models;

class SeatManager extends BaseManager
{
    public function createSeatsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS seats (
            id INT PRIMARY KEY AUTO_INCREMENT,
            room_id INT,
            seat_number VARCHAR(10),
            reserved_for_disabled BOOLEAN DEFAULT 0,
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